<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPagoRequest;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Cliente;
use App\Models\Pago;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PagosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pago_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pagos = Pago::with(['estudiante', 'media'])->get();

        $clientes = Cliente::get();

        return view('admin.pagos.index', compact('clientes', 'pagos'));
    }

    public function create()
    {
        abort_if(Gate::denies('pago_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estudiantes = Cliente::pluck('fullname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pagos.create', compact('estudiantes'));
    }

    public function store(StorePagoRequest $request)
    {
        $pago = Pago::create($request->all());

        if ($request->input('comprobante', false)) {
            $pago->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprobante'))))->toMediaCollection('comprobante');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pago->id]);
        }

        return redirect()->route('admin.pagos.index');
    }

    public function edit(Pago $pago)
    {
        abort_if(Gate::denies('pago_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estudiantes = Cliente::pluck('fullname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pago->load('estudiante');

        return view('admin.pagos.edit', compact('estudiantes', 'pago'));
    }

    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $pago->update($request->all());

        if ($request->input('comprobante', false)) {
            if (! $pago->comprobante || $request->input('comprobante') !== $pago->comprobante->file_name) {
                if ($pago->comprobante) {
                    $pago->comprobante->delete();
                }
                $pago->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprobante'))))->toMediaCollection('comprobante');
            }
        } elseif ($pago->comprobante) {
            $pago->comprobante->delete();
        }

        return redirect()->route('admin.pagos.index');
    }

    public function show(Pago $pago)
    {
        abort_if(Gate::denies('pago_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pago->load('estudiante');

        return view('admin.pagos.show', compact('pago'));
    }

    public function destroy(Pago $pago)
    {
        abort_if(Gate::denies('pago_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pago->delete();

        return back();
    }

    public function massDestroy(MassDestroyPagoRequest $request)
    {
        $pagos = Pago::find(request('ids'));

        foreach ($pagos as $pago) {
            $pago->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pago_create') && Gate::denies('pago_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pago();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
