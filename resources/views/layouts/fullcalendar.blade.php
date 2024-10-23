@extends('layouts.app')

@section('title', 'Calendario')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content_header')
    <h1 class="text-muted">Calendario</h1>
@stop

@section('content')
    <div id='calendar'></div>
@stop

@push('js')
    
    {{-- Incluir FullCalendar y configuraciones --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar citas diarias cuando cargue la página
            verificarCitasDiarias();
    
            // Función para verificar y mostrar las citas del día
            function verificarCitasDiarias() {
                fetch('/verificar-citas')
                    .then(response => response.json())
                    .then(citas => {
                        if (citas.length > 0) {
                            let listaCitas = citas.map(cita => {
                                return `Motivo: ${cita.motivo}, Paciente: ${cita.paciente}, Hora: ${cita.hora}`;
                            }).join('\n');
    
                            // Mostrar la alerta con las citas del día
                            Swal.fire({
                                title: 'Citas del día de hoy',
                                text: listaCitas,
                                icon: 'info',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener las citas:', error);
                    });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                editable: true,
                selectable: true,
                locale: 'es',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                events: '{{ route('calendario.citas') }}',
                eventClick: function(info) {

                    Swal.fire({
                        title: `Cita: ${info.event.title}`,
                        text: `¿Deseas realizar el control de la paciente ${info.event.extendedProps.paciente}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, realizar control',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `{{ route('consulta.Obtener') }}?id=${info.event.id}`;
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>
@endpush

@push('css')
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
@endpush
