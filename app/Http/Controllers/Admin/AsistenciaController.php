<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAsistenciumRequest;
use App\Http\Requests\StoreAsistenciumRequest;
use App\Http\Requests\UpdateAsistenciumRequest;
use App\Models\Asistencium;
use App\Models\Cliente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsistenciaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asistencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asistencia = Asistencium::with(['estudiante'])->get();

        return view('admin.asistencia.index', compact('asistencia'));
    }

    public function create()
    {
        abort_if(Gate::denies('asistencium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estudiantes = Cliente::pluck('fullname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.asistencia.create', compact('estudiantes'));
    }

    public function store(StoreAsistenciumRequest $request)
    {
        $asistencium = Asistencium::create($request->all());

        return redirect()->route('admin.asistencia.index');
    }

    public function edit(Asistencium $asistencium)
    {
        abort_if(Gate::denies('asistencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estudiantes = Cliente::pluck('fullname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asistencium->load('estudiante');

        return view('admin.asistencia.edit', compact('asistencium', 'estudiantes'));
    }

    public function update(UpdateAsistenciumRequest $request, Asistencium $asistencium)
    {
        $asistencium->update($request->all());

        return redirect()->route('admin.asistencia.index');
    }

    public function show(Asistencium $asistencium)
    {
        abort_if(Gate::denies('asistencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asistencium->load('estudiante');

        return view('admin.asistencia.show', compact('asistencium'));
    }

    public function destroy(Asistencium $asistencium)
    {
        abort_if(Gate::denies('asistencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asistencium->delete();

        return back();
    }

    public function massDestroy(MassDestroyAsistenciumRequest $request)
    {
        $asistencia = Asistencium::find(request('ids'));

        foreach ($asistencia as $asistencium) {
            $asistencium->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
