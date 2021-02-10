<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Solicitud de eliminación de datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/icons/iE_circle.png') }}">
    @include('subviews.imports')

    <!-- CSS Avatar -->
    <link rel="stylesheet" href="{{asset('css/simpatizante/aviso_datos.css')}}" />
</head>

<body>

    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-text-primary">iElect</h2>
            <h3 class="uk-text-center uk-text-large">
                Tus datos personales han sido eliminados con éxito de iElect.
            </h3>
            <p>
                Si tienes alguna duda sobre el uso que se le dio a tu información durante este tiempo puedes leer los
                Términos y Condiciones y el Aviso de privacidad de nuestra aplicación, también puedes comunicarte al
                número: (ahí iría un número que no tenemos).
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
                                ¿Quieres eliminar tus datos personales de iElect?
                            </h3>
                            <div class="uk-alert-danger" uk-alert id="errors" style="display: none">
                                <a class="uk-alert-close" uk-close></a>
                                <ul id="errors-list">
                                </ul>
                            </div>
                            <!--Input correo electronico-->
                            <div class="uk-margin">
                                <div class="uk-text uk-text-justify" id="texto">
                                    Si das clic en Enviar, la información personal que brindaste al brigadista para la
                                    campaña {{$campaign}} será eliminada de nuestra base de datos
                                    definitivamente. Si quieres seguir apoyando la campaña da clic en cancelar. Recuerda
                                    que la información personal que nos compartiste se usa sólo para los fines
                                    establecidos en el documento de Términos y condiciones y en el aviso de privacidad.
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
                                    <button class="uk-button uk-button-secundary" type="button"
                                        style="margin-left: 10px" id="btnCancelar">
                                        Cancelar
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
                <a href="https://dragonware.com.mx/" style="color:white !important" target="_blank"><small class="uk-align-center uk-align-right@m uk-text-center"
                    style="margin: 0px; padding-top: 50px">Desarrollado por DragonWare.<img src="{{asset('/img/icons/dragonBlanco.png')}}" style="width:20px; height:15px; margin-left:5px;"></small></a>
            </div>
        </div>
    </footer>
</body>

<script>
    $(document).ready(function(){
            $('#btnCancelar').click(function() {
                $('#btnCancelar').hide('fast');
                $('#btnEnviar').hide('fast');
                $('#texto').hide().html('Tus datos siguen con iElect. Gracias por tu confianza.').fadeIn(2000);
            });
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