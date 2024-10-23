<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>

    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">

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
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="logo">
            <img src="{{ asset('imagenes/302464652_537376068387806_7427466127821357187_n.png') }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            Crear una cuenta
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf        
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span> 
                <input type="name" name="name" id="name" placeholder="Nombre" required>
            </div>
            
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span> 
                <input type="email" name="email" id="email" placeholder="Correo" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-key"></span> 
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>
            <button class="btn mt-3" type="submit">Registrar</button>
        </form>
        <div class="text-center fs-6">
            <a href="{{route('login')}}">Ya tienes una cuenta?</a>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>
</body>
</html>
