@extends('layouts.app')

@section('css')
 
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Calendario de Citas</h2>
        <div id='calendar'></div> 
    </div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Vista inicial: calendario en formato mensual
        locale: 'es', // Localización en español
        events: '{{ route('calendario.citas') }}', // Ruta que devuelve el JSON de las citas

        eventClick: function(info) {
            alert('Cita: ' + info.event.title); // Muestra una alerta al hacer clic en un evento
        },

        // Depuración: ver los eventos cargados
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch('{{ route('calendario.citas') }}')
                .then(response => response.json())
                .then(events => {
                    console.log("Eventos cargados:", events);  // Aquí puedes ver si los eventos se cargan
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error al cargar eventos:', error);
                    failureCallback(error);
                });
        }
    });

    calendar.render();
});
    </script>
@endsection
