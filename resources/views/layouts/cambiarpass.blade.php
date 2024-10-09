@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Actualizar Contraseña del Usuario</h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.updatePassword', $user->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Para que funcione correctamente la actualización -->
            <!-- Para que funcione correctamente la actualización -->

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
