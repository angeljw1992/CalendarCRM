<div class="m-3"> 
    <div class="card">
        <div class="card-header">
            Tareas
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-estudianteTask">
                    <thead>
                        <tr> 
                            <th>
                                {{ 'Nombre' }}
                            </th>
                            <th>
                                {{ 'Grupo' }}
                            </th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $key => $pago)
                            <tr > 
                                <td>
                                    {{ $pago->name ?? '' }}
                                </td> 
                                <td>
                                    {{ $pago->grupo ?? '' }}
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 


<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let table = $('.datatable-estudianteTask').DataTable( {
    orderCellsTop:false,  
    select:false

  })
 
})

</script>