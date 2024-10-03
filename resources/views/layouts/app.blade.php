@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        @livewireStyles
        @vite('resources/css/app.css')

        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop
@section('navbar')
    <nav class="navbar navbar-expand navbar-light bg-light">
        <!-- Otros elementos de navegación -->

        <ul class="navbar-nav ml-auto">
            <!-- Botón de Logout personalizado -->
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('img/logout-icon.png') }}" alt="Logout" style="width: 20px; height: 20px;">
                    <span>Logout</span>
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </nav>
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
    @livewireScripts
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'UMG') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
@endpush
@endpush

{{-- Add common CSS customizations --}}

@push('css')
    <style type="text/css">
        {{-- You can add AdminLTE customizations here --}} .card-header {
            border-bottom: none;
        }

        .card-title {
            font-weight: 600;
        }
    </style>
@endpush
