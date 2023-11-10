@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.task.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tasks.update", [$task->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.task.fields.name') }}</label>
                <select class="form-control sl2 {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name">
                    <option value disabled {{ old('name', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Task::NAME_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('name', $task->name) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.task.fields.grupo') }}</label>
                <select class="form-control {{ $errors->has('grupo') ? 'is-invalid' : '' }}" name="grupo" id="grupo" required>
                    <option value disabled {{ old('grupo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Task::GRUPO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('grupo', $task->grupo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('grupo'))
                    <span class="text-danger">{{ $errors->first('grupo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.grupo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $task->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="final_date">{{ trans('cruds.task.fields.final_date') }}</label>
                <input class="form-control date {{ $errors->has('final_date') ? 'is-invalid' : '' }}" type="text" name="final_date" id="final_date" value="{{ old('final_date', $task->final_date) }}" required>
                @if($errors->has('final_date'))
                    <span class="text-danger">{{ $errors->first('final_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.final_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start">{{ trans('cruds.task.fields.start') }}</label>
                <input class="form-control timepicker {{ $errors->has('start') ? 'is-invalid' : '' }}" type="text" name="start" id="start" value="{{ old('start', $task->start) }}" required>
                @if($errors->has('start'))
                    <span class="text-danger">{{ $errors->first('start') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end">{{ trans('cruds.task.fields.end') }}</label>
                <input class="form-control timepicker {{ $errors->has('end') ? 'is-invalid' : '' }}" type="text" name="end" id="end" value="{{ old('end', $task->end) }}" required>
                @if($errors->has('end'))
                    <span class="text-danger">{{ $errors->first('end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.end_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.task.fields.dias') }}</label>
                <select class="form-control {{ $errors->has('dias') ? 'is-invalid' : '' }}" name="dias" id="dias" required>
                    <option value disabled {{ old('dias', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Task::DIAS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('dias', $task->dias) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('dias'))
                    <span class="text-danger">{{ $errors->first('dias') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.dias_helper') }}</span>
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
@section('scripts')
    <script>

$(function(){


    $('.sl2').select2({
                ajax: {
                    url: "{{ route('admin.task-statuses.list') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {

                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    }
                }
            });


});

    </script>
@endsection