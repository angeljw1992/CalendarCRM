@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pago.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pagos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.estudiante') }}
                        </th>
                        <td>
                            {{ $pago->estudiante->fullname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.concepto') }}
                        </th>
                        <td>
                            {{ App\Models\Pago::CONCEPTO_SELECT[$pago->concepto] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.monto') }}
                        </th>
                        <td>
                            {{ $pago->monto }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.metodo') }}
                        </th>
                        <td>
                            {{ App\Models\Pago::METODO_SELECT[$pago->metodo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.fecha_asignada_de_pago') }}
                        </th>
                        <td>
                            {{ $pago->fecha_asignada_de_pago }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.fecha') }}
                        </th>
                        <td>
                            {{ $pago->fecha }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.comprobante') }}
                        </th>
                        <td>
                            @if($pago->comprobante)
                                <a href="{{ $pago->comprobante->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pago.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $pago->descripcion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pagos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection