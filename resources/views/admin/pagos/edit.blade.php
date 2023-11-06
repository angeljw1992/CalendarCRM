@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pago.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pagos.update", [$pago->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="estudiante_id">{{ trans('cruds.pago.fields.estudiante') }}</label>
                <select class="form-control select2 {{ $errors->has('estudiante') ? 'is-invalid' : '' }}" name="estudiante_id" id="estudiante_id" required>
                    @foreach($estudiantes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('estudiante_id') ? old('estudiante_id') : $pago->estudiante->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('estudiante'))
                    <span class="text-danger">{{ $errors->first('estudiante') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.estudiante_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pago.fields.concepto') }}</label>
                <select class="form-control {{ $errors->has('concepto') ? 'is-invalid' : '' }}" name="concepto" id="concepto" required>
                    <option value disabled {{ old('concepto', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Pago::CONCEPTO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('concepto', $pago->concepto) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('concepto'))
                    <span class="text-danger">{{ $errors->first('concepto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.concepto_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="monto">{{ trans('cruds.pago.fields.monto') }}</label>
                <input class="form-control {{ $errors->has('monto') ? 'is-invalid' : '' }}" type="number" name="monto" id="monto" value="{{ old('monto', $pago->monto) }}" step="0.01" required>
                @if($errors->has('monto'))
                    <span class="text-danger">{{ $errors->first('monto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.monto_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pago.fields.metodo') }}</label>
                <select class="form-control {{ $errors->has('metodo') ? 'is-invalid' : '' }}" name="metodo" id="metodo" required>
                    <option value disabled {{ old('metodo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Pago::METODO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('metodo', $pago->metodo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('metodo'))
                    <span class="text-danger">{{ $errors->first('metodo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.metodo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fecha_asignada_de_pago">{{ trans('cruds.pago.fields.fecha_asignada_de_pago') }}</label>
                <input class="form-control date {{ $errors->has('fecha_asignada_de_pago') ? 'is-invalid' : '' }}" type="text" name="fecha_asignada_de_pago" id="fecha_asignada_de_pago" value="{{ old('fecha_asignada_de_pago', $pago->fecha_asignada_de_pago) }}" required>
                @if($errors->has('fecha_asignada_de_pago'))
                    <span class="text-danger">{{ $errors->first('fecha_asignada_de_pago') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.fecha_asignada_de_pago_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fecha">{{ trans('cruds.pago.fields.fecha') }}</label>
                <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text" name="fecha" id="fecha" value="{{ old('fecha', $pago->fecha) }}" required>
                @if($errors->has('fecha'))
                    <span class="text-danger">{{ $errors->first('fecha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.fecha_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comprobante">{{ trans('cruds.pago.fields.comprobante') }}</label>
                <div class="needsclick dropzone {{ $errors->has('comprobante') ? 'is-invalid' : '' }}" id="comprobante-dropzone">
                </div>
                @if($errors->has('comprobante'))
                    <span class="text-danger">{{ $errors->first('comprobante') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.comprobante_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.pago.fields.descripcion') }}</label>
                <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $pago->descripcion) }}">
                @if($errors->has('descripcion'))
                    <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pago.fields.descripcion_helper') }}</span>
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
    Dropzone.options.comprobanteDropzone = {
    url: '{{ route('admin.pagos.storeMedia') }}',
    maxFilesize: 3, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3
    },
    success: function (file, response) {
      $('form').find('input[name="comprobante"]').remove()
      $('form').append('<input type="hidden" name="comprobante" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="comprobante"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pago) && $pago->comprobante)
      var file = {!! json_encode($pago->comprobante) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="comprobante" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection