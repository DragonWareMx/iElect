<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Aviso de uso de datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @extends('subviews.imports')

    <!-- CSS Avatar -->
    <link rel="stylesheet" href="{{asset('css/simpatizante/aviso_datos.css')}}" />
</head>

<body>
    <div class="content">
        <h1 class="uk-text-primary uk-padding-small">iElect</h1>
        <div class="uk-padding-small">
            <p>
                Hola José Agustín Aguilar Solórzano, texto que explique que sus datos
                han sido subidos al sistema iElect, que es una plataforma para la
                asistencia de campañas políticas que facilita el seguimiento y el
                control de la información personal de sus simpatizantes allegados.
                Usted ha sido registrado como simpatizante para el partido político
                NDP, para la candidatura de Gobernador (nombre del candidat@) de
                Morelia, Michoacán. Los datos utilizados son: nombre, correo, edad,
                teléfono, etc...
            </p>
            <p>
                Si no fuiste informado de está acción, o deseas solicitar la baja de
                tus datos, <a>clic aquí.</a>
            </p>
            <p>
                Consulta el <a>Aviso de privacidad</a> y las
                <a>Políticas y condiciones</a> para mayor información.
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
                <a style="color: white">Aviso de privacidad</a>
            </div>
            <div class="uk-text-left@m uk-text-center">
                <a style="color: white">Politicas y condiciones</a>
            </div>
            <div class="uk-text-center uk-hidden@m">
                <small style="color: white"> Desarrollado por DragonWare. </small>
            </div>
            <div class="uk-position-small uk-position-bottom-right uk-visible@s">
                <small class="uk-align-right@m uk-text-center" style="color: white">
                    Desarrollado por DragonWare.
                </small>
            </div>
        </div>
    </footer>
</body>

</html>