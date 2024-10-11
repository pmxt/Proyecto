@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Perfil de Usuario</h2>
    
    <div class="card">
        <div class="card-header">
            Información Personal
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{  $user->name }}</p>
            <p><strong>Email:</strong> {{  $user->email }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <!-- Otros datos que desees mostrar -->
        </div>
    </div>

    <!-- Botón para editar el perfil -->
    <div class="mt-3">
        <a href="" class="btn btn-primary">Editar Perfil</a>
    </div>
</div>
@endsection
