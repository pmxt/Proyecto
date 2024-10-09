@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Gestión de Medicamentos</h2>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para agregar nuevos medicamentos -->
    <form action="{{ route('medicamentos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Medicamento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad Disponible</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Medicamento</button>
    </form>

    <hr>

    <!-- Tabla de medicamentos existentes -->
    <h4 class="text-center mt-4">Medicamentos Disponibles</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicamentos as $medicamento)
                <tr>
                    <td>{{ $medicamento->nombre }}</td>
                    <td>{{ $medicamento->cantidad }}</td>
                    <td>
                       
                        <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="btn btn-sm" title="Editar">
                            <i class="fa fa-edit"></i>
                        </a>

                       
                        <button type="button" class="btn btn-sm" title="Eliminar"
                            onclick="confirmDelete({{ $medicamento->id }}, '{{ $medicamento->nombre }}')">
                            <i class="fa fa-trash"></i>
                        </button>

                       
                        <form id="delete-form-{{ $medicamento->id }}" action="{{ route('medicamentos.destroy', $medicamento->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   
    {{ $medicamentos->links() }}
</div>


<script>
    function confirmDelete(id, name) {
        if(confirm('¿Estás seguro de que deseas eliminar el medicamento "' + name + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
<script>
    function confirmDelete(id, name) {
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
                
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
