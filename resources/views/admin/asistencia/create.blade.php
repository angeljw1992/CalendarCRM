@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.asistencium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.asistencia.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="estudiante_id">{{ trans('cruds.asistencium.fields.estudiante') }}</label>
                <select class="form-control select2 {{ $errors->has('estudiante') ? 'is-invalid' : '' }}" name="estudiante_id" id="estudiante_id" required>
                    @foreach($estudiantes as $id => $entry)
                        <option value="{{ $id }}" {{ old('estudiante_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('estudiante'))
                    <span class="text-danger">{{ $errors->first('estudiante') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asistencium.fields.estudiante_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.asistencium.fields.asistencia') }}</label>
                <select class="form-control {{ $errors->has('asistencia') ? 'is-invalid' : '' }}" name="asistencia" id="asistencia" required>
                    <option value disabled {{ old('asistencia', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Asistencium::ASISTENCIA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('asistencia', 'yes') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('asistencia'))
                    <span class="text-danger">{{ $errors->first('asistencia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asistencium.fields.asistencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fecha">{{ trans('cruds.asistencium.fields.fecha') }}</label>
                <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                @if($errors->has('fecha'))
                    <span class="text-danger">{{ $errors->first('fecha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asistencium.fields.fecha_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fecha_reposicion">{{ trans('cruds.asistencium.fields.fecha_reposicion') }}</label>
                <input class="form-control date {{ $errors->has('fecha_reposicion') ? 'is-invalid' : '' }}" type="text" name="fecha_reposicion" id="fecha_reposicion" value="{{ old('fecha_reposicion') }}">
                @if($errors->has('fecha_reposicion'))
                    <span class="text-danger">{{ $errors->first('fecha_reposicion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asistencium.fields.fecha_reposicion_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection