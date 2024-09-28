@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Para que funcione correctamente la actualización -->
        
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
