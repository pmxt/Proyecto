<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restablecer Contraseña</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <!-- Bootstrap CSS v5.3.2 -->
    <link   
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    >
</head>
<body>
    <div class="wrapper">
        <!-- Logo de la empresa -->
        <div class="logo">
            <img src="{{ asset('imagenes/302464652_537376068387806_7427466127821357187_n.png') }}" alt="Logo">
        </div>

        <!-- Título de la vista -->
        <div class="text-center mt-4 name">
            Restablecer Contraseña
        </div>

        <!-- Mensaje de éxito al enviar el correo de restablecimiento -->
        @if (session('status'))
            <div class="alert alert-success text-center mt-3">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario para solicitar el restablecimiento de la contraseña -->
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <p>Ingresa tu correo electrónico</p>

            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span> 
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3">
                    Solicitar
                </button>
            </div>
        </form>

        <!-- Enlaces para volver al inicio de sesión o crear una cuenta -->
        <div class="text-center fs-6 mt-3">
            <a href="{{ route('login') }}">Volver a Iniciar Sesión</a> o <a href="{{ route('register') }}">Crear cuenta</a>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4lJQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>
</body>
</html>
