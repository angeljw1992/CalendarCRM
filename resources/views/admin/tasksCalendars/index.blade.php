@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.tasksCalendar.title') }}
    </div>

    <div class="card-body">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <div id="calendar"></div>

    </div>
	
</div>



@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
$(document).ready(function() {
    // Inicializa el calendario
    $('#calendar').fullCalendar({
        defaultView: 'month', // Mostrar la vista mensual por defecto
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay' // Permitir cambiar entre las vistas de mes, semana y día
        },
        locale: 'es', // Establece la localización a español

        events: function(start, end, timezone, callback) {
            var events = [];
            @foreach($events as $event)
                @if($event->due_date && $event->dias)
                    @php
                        $start = \Carbon\Carbon::createFromFormat(config('panel.date_format'), $event->due_date);
                        $end = \Carbon\Carbon::createFromFormat(config('panel.date_format'), $event->final_date);
                        $currentDate = clone $start;
                        $dias = explode(',', $event->dias); // Asume que 'dias' es una cadena separada por comas
                        $dias = array_map(function($dia) { return ($dia % 7); }, $dias); // Ajusta los números de los días de la semana para que coincidan con JavaScript
                    @endphp
				
                    @while($currentDate <= $end)
                        @if(in_array($currentDate->dayOfWeek, $dias)) // Asume que 'dias' contiene los números de los días de la semana (0 = domingo, 1 = lunes, ..., 6 = sábado)
                            events.push({
                                title: '{{ $event->name }} - {{ $event->grupo }}',
                                start: '{{$currentDate->format('Y-m-d')}}T{{ $event->hora_inicio }}',
                                end: '{{$currentDate->format('Y-m-d')}}T{{ $event->hora_final }}',
                                url: '{{ url('admin/tasks').'/'.$event->id.'/' }}',
                                color: '{{ $event->grupo == "infantil" ? "blue" : ($event->grupo == "adulto" ? "green" : "") }}'
                            });
                        @endif
                        @php
                            $currentDate->addDay();
                        @endphp
                    @endwhile
                @endif
            @endforeach
            callback(events);
        }
    });
});
</script>

@stop