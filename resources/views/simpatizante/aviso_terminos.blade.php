<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Términos y condiciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/icons/iE_circle.png') }}">
    @extends('subviews.imports')

    <!-- CSS Avatar -->
    <link rel="stylesheet" href="{{asset('css/simpatizante/aviso_datos.css')}}" />
</head>

<body>
    <div class="content">
        <h1 class="uk-text-primary uk-padding-small">iElect</h1>
        <div class="uk-padding-small">
            <h5 class="uk-text-primary uk-padding-small">Términos y condiciones</h5>
            <p>
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
                Texto generico que explique los terminos y condiciones
            </p>
            <p>
                Texto generico que explique los terminos y condiciones

            </p>
            <p>
                Texto generico que explique los terminos y condiciones

            </p>
        </div>
    </div>
    <footer class="footer uk-background-primary">
        <div class="uk-padding uk-child-width-1-6@s uk-grid-match" uk-grid>
            <div class="uk-text-left@m uk-text-center">
                <h2 style="color: white; margin: 0 !important">iElect</h2>
                <small style="color: white">Copyright ©2021 iElect</small>
            </div>
            <div class="uk-text-left@m uk-text-center">
                <a style="color: white" href="{{ route('avisoprivacidad') }}">Aviso de privacidad</a>
            </div>
            <div class="uk-text-left@m uk-text-center">
                <a style="color: white" href="{{ route('terminoscondiciones') }}">Términos y condiciones</a>
            </div>
            <div class="uk-text-center uk-hidden@m">
                <small style="color: white"> Desarrollado por DragonWare. </small>
            </div>
            <div class="uk-position-small uk-position-bottom-right uk-visible@s">
                <a href="https://dragonware.com.mx/" style="color:white !important" target="_blank"><small class="uk-align-center uk-align-right@m uk-text-center"
                    style="margin: 0px; padding-top: 50px">Desarrollado por DragonWare.<img src="{{asset('/img/icons/dragonBlanco.png')}}" style="width:20px; height:15px; margin-left:5px;"></small></a>
            </div>
        </div>
    </footer>
</body>

</html>