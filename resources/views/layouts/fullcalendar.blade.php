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
                events: '{{ route('calendario.citas') }}', // Cargar las citas desde el backend
                eventClick: function(info) {
                    // Usar SweetAlert para mostrar el mensaje
                    Swal.fire({
                        title: `Cita: ${info.event.title}`,
                        text: `¿Deseas realizar el control de la paciente ${info.event.extendedProps.paciente}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, realizar control',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma, redirigir a la página del control de paciente
                            window.location.href = `{{ route('consulta.Obtener') }}?id=${info.event.id}`;
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
