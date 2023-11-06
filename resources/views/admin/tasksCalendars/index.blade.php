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
            events: [
                @foreach($events as $event)
                    @if($event->due_date)
                        @php
                            $start = \Carbon\Carbon::createFromFormat(config('panel.date_format'), $event->due_date)->format('Y-m-d');
                            $end = \Carbon\Carbon::createFromFormat(config('panel.date_format'), $event->final_date)->format('Y-m-d');
                            $currentDate = $start;
                        @endphp
                        @while($currentDate <= $end)
                            {
								
                                title: '{{ $event->name }} - {{ $event->grupo }}', // Combina título y descripción
                                start: '{{$currentDate}}T{{ $event->start }}',
								end: '{{$currentDate}}T{{ $event->end }}',
                                url: '{{ url('admin/tasks').'/'.$event->id.'/' }}'
                            },
                            @php
                                $currentDate = \Carbon\Carbon::parse($currentDate)->addWeek()->format('Y-m-d');
                            @endphp
                        @endwhile
                    @endif
                @endforeach
            ]
        });
    });
</script>

@stop