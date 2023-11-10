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
                </tbody>
            </table>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('admin.tasks.client.add') }}" method="post">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Cliente</label>
                        <select name="client_id" class="form-control">

                            @foreach ($clients_all as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->fullname . ' - ' . $item->identificacion }}</option>
                            @endforeach

                        </select>
                    </div>





                </div>
                <div class="modal-footer">
                    <button role="button" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>


            </form>




        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });

            let table = $('.datatable-Cliente:not(.ajaxTable)').DataTable({
                //  buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });


            $(".rem_tc").click(function(e) {
                e.preventDefault();
                e.stopPropagation();

                var form = {}
                form.id =  $(this).attr("data-id");
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


        });
    </script>
@endsection
