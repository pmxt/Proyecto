@extends('layouts.app')
@section('css') 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endsection

@section('content')
    <div class="wrapper">
        <div class="logo text-center">
            <img src="{{ asset('imagenes/MPS.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <div class="text-center mt-4 name">
            <h2>Perfil de Usuario</h2>
        </div>

        <div class="card mt-4 mx-auto" style="max-width: 600px;">
            <div class="card-header text-center">
                <h4>Información Personal</h4>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                
            </div>
        </div>

      <div class="mb-3 d-flex flex-column flex-md-row justify-content-center">
        
            <a href=" {{ route('users.editP') }} " class="btn btn-secondary mr-md-2 mb-2 mb-md-0">Editar Perfil</a>
        
        
            <a href="{{ route('users.password') }}" class="btn btn-secondary">Cambiar contraseña</a>

        
        </div>  
        
    </div>
@endsection
