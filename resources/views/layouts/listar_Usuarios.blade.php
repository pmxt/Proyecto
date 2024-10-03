@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
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
                                <!-- Botón de editar -->
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Botón de eliminar -->
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Formulario de eliminación oculto -->
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }} <!-- Paginación -->
        </div>
    </div>
    <script>
        function confirmDelete(userId, userName) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma la eliminación, enviamos el formulario
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
@endsection