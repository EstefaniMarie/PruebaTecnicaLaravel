<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('asset/css/bootstrap.min.css') }}">
</head>

<body>
<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <section id="account-login" class="flexbox-container">
        <div class="row">
            <!-- Columna para la imagen -->
            <div class="col-md-6 mt-4">
                <img src="images/login.png" class="card-account-img mx-auto d-block mt-5" style="width: 300px;" alt="card-account-img">
            </div>
            <!-- Columna para el formulario -->
            <div class="col-md-6 mt-3 mb-3">
                <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right">
                    <div class="card-content">
                        <div class="card-body p-4">
                            <p class="text-center h5 text-capitalize">{{ __('Bienvenido a ' . config('app.name', 'MINAGUAS') . '!') }}</p>
                            <p class="mb-3 text-center">{{ __('Por favor ingresa tu correo y contraseña') }}</p>
                            <form class="form-horizontal form-signin" action="{{ route('login') }}" method="POST">
                                @include('layouts.partials.messages')
                                @csrf
                                <div class="form-group">
                                    <label for="correo" class="form-label">Correo Electrónico</label>
                                    <input id="correo" class="form-control" type="email" name="correo" required autofocus autocomplete="email"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-12 text-center text-sm-left">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" class="chk-remember">
                                            <label for="remember-me"> Recordar</label>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Ingresar') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <script src="{{ url('asset/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

<style>
    body {
        background-size: 100%;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-image: url('images/bg-01.jpg');
        background-size: cover;
        opacity: 0.9;
    }
</style>