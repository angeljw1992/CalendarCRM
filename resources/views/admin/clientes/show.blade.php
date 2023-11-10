@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cliente.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.fullname') }}
                        </th>
                        <td>
                            {{ $cliente->fullname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.identificacion') }}
                        </th>
                        <td>
                            {{ $cliente->identificacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.fecha_nacimiento') }}
                        </th>
                        <td>
                            {{ $cliente->fecha_nacimiento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.correo') }}
                        </th>
                        <td>
                            {{ $cliente->correo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.telefono') }}
                        </th>
                        <td>
                            {{ $cliente->telefono }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.nivel') }}
                        </th>
                        <td>
                            {{ App\Models\Cliente::NIVEL_SELECT[$cliente->nivel] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.observaciones') }}
                        </th>
                        <td>
                            {{ $cliente->observaciones }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.activo') }}
                        </th>
                        <td>
                            {{ App\Models\Cliente::ACTIVO_SELECT[$cliente->activo] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item active">
            <a class="nav-link  active" href="#estudiante_pagos" role="tab" data-toggle="tab">
                {{ trans('cruds.pago.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#estudiante_asistencia" role="tab" data-toggle="tab">
                {{ trans('cruds.asistencium.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#estudiante_task" role="tab" data-toggle="tab">
                {{ 'Tareas' }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="estudiante_pagos">
            @includeIf('admin.clientes.relationships.estudiantePagos', ['pagos' => $cliente->estudiantePagos])
        </div>
        <div class="tab-pane" role="tabpanel" id="estudiante_asistencia">
            @includeIf('admin.clientes.relationships.estudianteAsistencia', ['asistencia' => $cliente->estudianteAsistencia])
        </div>
        <div class="tab-pane" role="tabpane2" id="estudiante_task">
            @includeIf('admin.clientes.relationships.tasks', ['tasks' => $taks])
        </div>
    </div>
</div>

@endsection