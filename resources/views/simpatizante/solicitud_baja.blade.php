<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Solicitud de eliminación de datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @include('subviews.imports')

    <!-- CSS Avatar -->
    <link rel="stylesheet" href="{{asset('css/simpatizante/aviso_datos.css')}}" />
</head>

<body>

    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-text-primary">iElect</h2>
            <h3 class="uk-text-center">
                Solicitud de eliminación de datos enviada correctamente
            </h3>
            <p>
                Su solicitud fue enviada exitosamente, y será recibida por el coordinador de la campaña, usted será
                notificado mediante un mensaje cuando la eleminación de su información se haya efectuado correctamente
            </p>
        </div>
    </div>

    <div class="content uk-section-muted">
        <h1 class="uk-text-primary uk-padding-small">iElect</h1>
        <div class="uk-padding-small">
            <div class="uk-section uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
                <div class="uk-card uk-card-default uk-width-1-2@m uk-position-center">
                    <div class="uk-child-width-expand uk-padding-large" uk-grid>
                        <div class="uk-width-expand@m uk-width-xlarge">
                            <h3 class="uk-card-title uk-text-bold uk-text-left@m uk-text-center">
                                Solicitud de eliminación de datos
                            </h3>
                            <div class="uk-alert-danger" uk-alert id="errors" style="display: none">
                                <a class="uk-alert-close" uk-close></a>
                                <ul id="errors-list">
                                </ul>
                            </div>
                            <!--Input correo electronico-->
                            <div class="uk-margin">
                                <div class="uk-text">
                                    Texto que diga que se van a eliminar los datos de forma chida
                                </div>
                            </div>
                            <!--Div grid-->
                            <div class="uk-child-width-1-1 uk-grid">
                                <!--Botón inicio-->
                                <form class="uk-text-left@m uk-text-center uk-margin-top" method="POST"
                                    action="{{ route('solicitud_baja-delete',['uuid'=>$uuid]) }}"
                                    id="form-delete-datos">
                                    @csrf @method('DELETE')
                                    <input type="hidden" value="{{$uuid}}" name="uuid">
                                    <button class="uk-button uk-button-primary" id="btnEnviar">
                                        Enviar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<script>
    $(document).ready(function(){
            //ajax del form de eliminar
            $("#form-delete-datos").bind("submit",function(){
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

</html>