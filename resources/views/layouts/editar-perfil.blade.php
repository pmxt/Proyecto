@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Perfil</h2>

    <form action="{{ route('perfil.actualizar') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
    </form>
</div>
@endsection
