<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registro brigadista</title>
    <link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @include('subviews.imports')
</head>

<body>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif --}}
    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-text-primary">iElect</h2>
            <h3 class="uk-text-center">
                Solicitud de registro enviada correctamente
            </h3>
            <p class="uk-text-justify">
                Su solicitud fue enviada exitosamente, y será recibida por el
                coordinador de la campaña, usted será notificado mediante el correo
                electrónico proporcionado para que pueda ingresar al sistema como
                brigadista. ¡Gracias!
            </p>
        </div>
    </div>


    <div class="uk-container uk-flex uk-flex-middle uk-flex-center" style="padding: 0px; min-height:100vh">
        <div class="uk-grid uk-grid-stack" uk-grid>
            <div class="uk-width-5-6@m uk-margin-auto">
                <div class="uk-card uk-card-default uk-card-large uk-grid-collapse uk-child-width-1-2@s uk-margin uk-border-rounded uk-position-relative uk-overflow-hidden"
                    uk-grid>
                    <div
                        class="uk-card-media-right uk-cover-container uk-text-center uk-margin-auto-vertical uk-width-1-3@m">
                        <h1 class="uk-text-primary" style="font-size: 80px">iElect</h1>
                        <small class="uk-text-muted uk-visible@m">Copyright ©2021 iElect</small>
                        <canvas width="400" height="1"></canvas>
                    </div>
                    <div class="uk-width-expand@m">
                        <div class="uk-card-body" style="padding-top: 2.5rem; padding-bottom:2.5rem">
                            <h3 class="uk-card-title uk-text-bold uk-text-left@m uk-text-center uk-margin-small-top">
                                Registro Brigadista
                            </h3>
                            <div class="uk-alert-danger" uk-alert id="errors" style="display: none">
                                <a class="uk-alert-close" uk-close></a>
                                <ul id="errors-list">
                                </ul>
                            </div>
                            <form class=" uk-margin-small-top" action="{{ route('registro.brig') }}" method="POST"
                                id="form-brigadista">
                                @csrf
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
                                        <input type="text" id="nombre" name="nombre" required autocomplete="off" />
                                        <span class="omrs-input-label">Nombre completo</span>
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                    </label>
                                </div>
                                <!--Input correo electrónico-->
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined input-lead-icon">
                                        <input type="email" id="email" name="email" required autocomplete="off" />
                                        <span class="omrs-input-label">Correo electrónico</span>
                                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    </label>
                                </div>
                                <!--Input contraseña-->
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined input-lead-icon">
                                        <input type="password" id="password" name="password" required
                                            autocomplete="off" />
                                        <span class="omrs-input-label">Contraseña</span>
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    </label>
                                </div>
                                <!--Input confirmar contraseña-->
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined input-lead-icon">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            required onkeyup="validatePassword()" />
                                        <span class="omrs-input-label">Confirmar contraseña</span>
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    </label>
                                </div>

                                <div class="uk-text-left@m uk-text-center uk-margin-top">
                                    {{-- <button class="uk-button uk-button-primary" uk-toggle="target: #modal-close-default"> --}}
                                    <button class="uk-button uk-button-primary" id="btnEnviar">
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
        </div>
    </div>


    <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("password_confirmation");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no coinciden");
                confirm_password.reportValidity();
            } else {
                confirm_password.setCustomValidity('');
                confirm_password.reportValidity();
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            //ajax del form de eliminar
            $("#form-brigadista").bind("submit",function(){
                // Capturamnos el boton de envío
                var btnEnviar = $("#btnEnviar");

                $.ajax({
                    type: $(this).attr("method"),
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    beforeSend: function(data){
                        /*
                        * Esta función se ejecuta durante el envió de la petición al
                        * servidor.
                        * */
                        // btnEnviar.text("Enviando"); Para button
                        btnEnviar.val("Enviando"); // Para input de tipo button
                        btnEnviar.attr("disabled","disabled");
                    },
                    complete:function(data){
                        /*
                        * Se ejecuta al termino de la petición
                        * */
                        btnEnviar.val("Enviar formulario");
                    },
                    success: function(data){
                        /*
                        * Se ejecuta cuando termina la petición y esta ha sido
                        * correcta
                        * */
                        $('#errors').css('display', 'none');

                        UIkit.modal('#modal-close-default').show();
                    },
                    error: function(data){
                        /*
                        * Se ejecuta si la peticón ha sido erronea
                        * */
                        btnEnviar.removeAttr("disabled");
                        $('#errors').css('display', 'block');
                        var errors = data.responseJSON.errors;
                        var errorsContainer = $('#errors-list');
                        errorsContainer.innerHTML = '';
                        var errorsList = '';
                        for(var key in errors){
                            var obj=errors[key];
                            for(var yek in obj){
                                var error=obj[yek];
                                errorsList += '<li>'+ error +'</li>';
                            }
                        }
                        errorsContainer.html(errorsList);
                    }
                });
                // Nos permite cancelar el envio del formulario
                return false;
            });
        });
    </script>
</body>

</html>