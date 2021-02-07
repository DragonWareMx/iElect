<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/icons/iE_circle.png') }}">
    @include('subviews.imports')

</head>

<body>
    <div>
        <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
            <div class="uk-card uk-card-default uk-width-1-2@m uk-position-center">
                <form class="uk-child-width-expand uk-padding-large" uk-grid method="POST"
                    action="{{ route('password.email') }}">
                    @csrf
                    <div class="uk-width-1-3@m uk-text-center uk-margin-auto-vertical">
                        <h1 class="uk-text-primary" style="font-size: 80px">iElect</h1>
                        <small class="uk-text-muted uk-visible@m">Copyright ©2021 iElect</small>
                    </div>
                    <div class="uk-width-expand@m">
                        <h3 class="uk-card-title uk-text-bold uk-text-left@m uk-text-center">
                            Recuperar Contraseña
                        </h3>
                        <p class="uk-text-left@m uk-text-center">
                            Se enviará un mensaje al correo electrónico para restaurar la
                            contraseña
                        </p>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <!--Input correo electronico-->
                        <div class="uk-margin">
                            <div class="omrs-input-group">
                                <label class="omrs-input-underlined input-outlined input-lead-icon">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autocomplete="email" />
                                    <span class="omrs-input-label">Correo electrónico</span>
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                </label>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Div grid-->
                        <div class="uk-child-width-1-1 uk-grid">
                            <!--Olvidaste tu contraseña-->
                            <div>
                                <p class="uk-text-right@m uk-text-center">
                                    ¿Listo para iniciar sesión?
                                    <a class="uk-link-heading uk-text-primary" href="{{route('login')}}">Clic aquí</a>
                                </p>
                            </div>
                            <!--Botón inicio-->
                            <div class="uk-text-left@m uk-text-center uk-margin-top">
                                <button class="uk-button uk-button-primary">Enviar</button>
                            </div>
                            <small class="uk-text-muted uk-text-center uk-hidden@m">Copyright ©2021 iElect</small>
                        </div>
                        <div>
                            <a href="https://dragonware.com.mx/" target="_blank"><small class="uk-align-center uk-align-right@m uk-text-center uk-text-muted"
                                style="margin: 0px; padding-top: 50px">Desarrollado por DragonWare.<img src="{{asset('/img/icons/dragonGris.png')}}" style="width:20px; height:15px; margin-left:5px; margin-bottom:3px"></small></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>