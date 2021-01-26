<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registro brigadista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @include('subviews.imports')
</head>

<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-text-primary">iElect</h2>
            <h3 class="uk-text-center">
                Solicitud de registro enviada correctamente
            </h3>
            <p>
                Su solicitud fue enviada exitosamente, y será recibida por el
                coordinador de la campaña, usted será notificado mediante el correo
                electrónico proporcionado para que pueda ingresar al sistema como
                brigadista. ¡Gracias!
            </p>
        </div>
    </div>

    <div>
        <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
            <div class="uk-card uk-card-default uk-position-center">
                <div class="uk-child-width-expand uk-padding-large" uk-grid>
                    <div class="uk-width-auto@m uk-text-center uk-margin-auto-vertical">
                        <h1 class="uk-text-primary" style="font-size: 80px">iElect</h1>
                        <small class="uk-text-muted uk-visible@m">Copyright ©2021 iElect</small>
                    </div>
                    <form class="uk-width-expand@m uk-width-xlarge" action="{{ route('registro.brig') }}" method="POST">
                        @csrf
                        <h3 class="uk-card-title uk-text-bold uk-text-left@m uk-text-center">
                            Registro Brigadista
                        </h3>
                        <!--Input código de campaña-->
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined input-lead-icon">
                                <input type="text" id="codigo" name="codigo" required autocomplete="off" />
                                <span class="omrs-input-label">Código de campaña</span>
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            </label>
                        </div>
                        <!--Input nombre completo-->
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined input-lead-icon">
                                <input type="text" id="nombre" name="nombre" required />
                                <span class="omrs-input-label">Nombre completo</span>
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                            </label>
                        </div>
                        <!--Input correo electrónico-->
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined input-lead-icon">
                                <input type="email" id="email" name="email" required />
                                <span class="omrs-input-label">Correo electrónico</span>
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            </label>
                        </div>
                        <!--Input contraseña-->
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined input-lead-icon">
                                <input type="password" id="password" name="password" required />
                                <span class="omrs-input-label">Contraseña</span>
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            </label>
                        </div>
                        <!--Input confirmar contraseña-->
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined input-lead-icon">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    required />
                                <span class="omrs-input-label">Confirmar contraseña</span>
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            </label>
                        </div>

                        <div class="uk-text-left@m uk-text-center uk-margin-top">
                            {{-- <button class="uk-button uk-button-primary" uk-toggle="target: #modal-close-default"> --}}
                            <button class="uk-button uk-button-primary">
                                Enviar
                            </button>
                        </div>
                        <div>
                            <small class="uk-align-center uk-align-right@m uk-text-center uk-text-muted"
                                style="margin: 0px; padding-top: 50px">Desarrollado por DragonWare.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>