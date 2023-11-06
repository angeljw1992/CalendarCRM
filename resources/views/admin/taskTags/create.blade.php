@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taskTag.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-tags.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="aa">{{ trans('cruds.taskTag.fields.aa') }}</label>
                <input class="form-control {{ $errors->has('aa') ? 'is-invalid' : '' }}" type="text" name="aa" id="aa" value="{{ old('aa', '') }}">
                @if($errors->has('aa'))
                    <span class="text-danger">{{ $errors->first('aa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taskTag.fields.aa_helper') }}</span>
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