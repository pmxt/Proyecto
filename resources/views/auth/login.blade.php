    <!doctype html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ingreso</title>

        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <div class="wrapper">

            <div class="logo">
                <img src="{{ asset('imagenes/302464652_537376068387806_7427466127821357187_n.png') }}" alt="">
            </div>
            <div class="text-center mt-4 name">
                Ingreso de usuario
            </div>
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
            <!-- Mensaje de éxito al enviar el correo de restablecimiento -->
            @if (session('status'))
                <div class="alert alert-success text-center mt-3">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <p>Ingresa tu correo</p>

                <div class="form-field d-flex align-items-center">
                    <span class="far fa-user"></span>
                    <input type="email" name="email" id="email" placeholder="Correo" required>
                </div>
                <p>Ingresa tu contraseña</p>
                <div class="form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                </div>
                <button class="btn mt-3">Ingresar</button>
            </form>
            <div class="text-center fs-6">
                <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a> o <a
                    href="{{ route('register') }}">Crear cuenta</a>
            </div>
        </div>
        </form>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    </body>

    </html>
