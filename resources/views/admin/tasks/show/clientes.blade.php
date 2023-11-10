<div class="card">
    <div class="card-header w-100">
        {{ trans('cruds.cliente.title_singular') }} {{ trans('global.list') }}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            Agregar Cliente
        </button>

    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Cliente">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.fullname') }}
                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.identificacion') }}
                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.fecha_nacimiento') }}
                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.telefono') }}
                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.nivel') }}
                        </th>
                        <th>
                            {{ trans('cruds.cliente.fields.activo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $key => $cliente)
                        <tr data-entry-id="{{ $cliente->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cliente->fullname ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->identificacion ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->fecha_nacimiento ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->telefono ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Cliente::NIVEL_SELECT[$cliente->nivel] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Cliente::ACTIVO_SELECT[$cliente->activo] ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-danger rem_tc" data-id="{{ $cliente->tk_id }}" href="#">
                                    <i class="fa fa-times"></i>
                                </a>

                            </td>

                        </tr>
                    @endforeach
                    <tr>

                        <td>
                            <h1><i class="fa fa-plus"></i></h1>
                        </td>
                        <td colspan="6">
                            <form action="{{ route('admin.tasks.client.add') }}" method="post" class="agcl">
                                @csrf
                                <input type="hidden" name="task_id" value="{{ $task->id }}">

                                <div class="form-group">
                                    <select name="client_id" class="form-control sl2" style="width:100%">
                                    </select>
                                </div>



                            </form>

                        </td>
                        <td>
                            <button role="button" type="button" class="btn btn-secondary agr">Agregar CLiente</button>


                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@section('scripts')
    <script>
        $(function() {

            $('.agr').click(function(){
                $('.agcl').submit();
            });

            $('.sl2').select2({
                ajax: {
                    url: "{{ route('admin.tasks.client.list') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {

                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.fullname,
                                    id: item.id,
                                }
                            })
                        };
                    }
                }
            });







            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });



            $(".rem_tc").click(function(e) {
                e.preventDefault();
                e.stopPropagation();

                var form = {}
                form.id = $(this).attr("data-id");
                form._token = '{{ csrf_token() }}';

                var url = "{{ route('admin.tasks.client.destroy') }}";



                $.confirm({
                    title: "Eliminar cliente de la lista",
                    content: "¿Estás seguro de que quieres realizar esta operación?",
                    buttons: {
                        "Sí": function() {


                            $.ajax({
                                type: 'post',
                                url: url,
                                data: JSON.stringify(form),
                                processData: false,
                                contentType: "application/json",
                                cache: false,
                                beforeSend: function() {

                                },
                                error: function() {},
                                success(response) {},
                                statusCode: {
                                    301: function() {
                                        location.reload();
                                    }
                                },
                                xhr: function() {
                                    var xhr = $.ajaxSettings.xhr();
                                    xhr.onprogress = function e() {};
                                    xhr.upload.onprogress = function(e) {};
                                    return xhr;
                                },
                            }).always(function(response, type, data) {

                                location.reload();

                            });




                        },
                        "No": function() {

                        },
                    }
                });





            });


            let table = $('.datatable-Cliente:not(.ajaxTable)').DataTable({
                //  buttons: dtButtons
            }) 

        });
    </script>
@endsection
