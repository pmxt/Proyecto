@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Actualizar Contraseña del Usuario</h2>

     
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.updatePassword') }}" method="POST">
            @csrf
            @method('POST') 

            <div class="form-group">
                <label>Contraseña actual</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Confirmar nueva contraseña</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        </form>
    </div>
@endsection
