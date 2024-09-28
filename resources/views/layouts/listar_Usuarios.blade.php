@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Lista de Usuarios</h2>

        <form method="GET" action="{{ route('listaUsuarios') }}">
            <input type="text" name="search" placeholder="Buscar por nombre o email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-warning">Buscar</button>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-sm w-150 text-sm">
                <thead>
                    <tr>
                        <th class="col-12 col-md-4 ">Nombre</th>
                        <th class="col-12 col-md-4">Email</th>
                        <th class="col-12 col-md-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="min-w-44">{{ $user->name }}</td>
                            <td class="min-w-44">{{ $user->email }}</td>
                            <td>
                                <!-- Icono de editar -->
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    Editar <i class="fa fa-edit"></i>
                                </a>

                                <!-- Icono de eliminar -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar al usuario {{ $user->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Eliminar <i class="fa fa-trash btn-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }} <!-- Paginación -->
        </div>
    </div>
@endsection
