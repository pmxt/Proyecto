
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sisitema de control prenatal</h1>
@stop

@section('content')
    <p>Bienvenido al panel dashbord principal</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop