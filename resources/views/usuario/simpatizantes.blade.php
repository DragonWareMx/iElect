@extends('layouts.layout')

@section('title')
Simpatizantes
@endsection

@section('imports')
<!-- CSS Avatar -->
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" />
<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/usuario/seccion.css')}}" />
@endsection

@section('body')
<!-- Modal Datos Simpatizante -->
<div id="modal-datos-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Simpatizante #</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-text-center">
                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="150"
                            height="150" alt="Border circle" />
                    </div>
                    <div class="uk-text-bold">Nombre</div>
                    <div>José Agustín Aguilar Solórzano</div>
                    <br />
                    <div class="uk-text-bold">Domicilio</div>
                    <div>Morelia, Centro #442</div>
                    <br />
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Edad</div>
                            <div>32</div>
                            <br />
                            <div class="uk-text-bold">Ocupación</div>
                            <div>Escritor</div>
                            <br />
                            <div class="uk-text-bold">Correo electrónico</div>
                            <div>correo@ejemplo.com</div>
                            <br />
                            <div class="uk-text-bold">Sección electoral</div>
                            <div>#</div>
                            <br />
                            <div class="uk-text-bold">Clave de elector</div>
                            <div>#########</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Sexo</div>
                            <div>Masculino</div>
                            <br />
                            <div class="uk-text-bold">Teléfono</div>
                            <div>1234567891</div>
                            <br />
                            <div class="uk-text-bold">Facebook</div>
                            <div>link</div>
                            <br />
                            <div class="uk-text-bold">Twitter</div>
                            <div>link</div>
                            <br />
                            <div class="uk-text-bold">Brigadista</div>
                            <div>#######</div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <img class="uk-margin-bottom" data-src="images/ine_front.jpg" width="75%" height="auto" alt=""
                        uk-img />
                    <img data-src="images/ine_back.jpg" width="75%" height="auto" alt="" uk-img />
                </div>
            </div>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Editar
                </button>
            </p>
        </div>
    </div>
</div>

<!-- Modal Agregar Simpatizante -->
<div id="modal-agregar-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Agregar simpatizante</h2>
        </div>
        <div id="errors" class="uk-alert-danger" uk-alert style="display:none;"></div>
        {{-- enctype="multipart/form-data" --}}
        <form id="form-nuevo-simp" class="uk-modal-body" action="{{ route('agregar-simpatizante') }}" method="POST" enctype="multipart/form-data">
            <div class="uk-modal-body">
                    @csrf
                    <div uk-grid>
                        <!-- Lado izquierdo -->
                        <div class="uk-width-1-2@m">
                            {{--<!-- Avatar -->
                            <div class="avatar-wrapper uk-margin-bottom">
                                <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200"
                                    height="200" alt="Border circle" />
                                <div class="upload-text">
                                    Editar foto
                                    <span class="uk-margin-small-left" uk-icon="upload"></span>
                                </div>
                            </div>
                            --}}

                            @if (!is_null($secciones) && count($secciones) > 0)
                                <h6 class="uk-text-bold">Secciones</h6>
                                <div class="select">
                                    <select class="select-text" required name="seccion">
                                        @foreach ($secciones as $seccion)
                                            <option value="{{ $seccion->id }}">Sección {{ $seccion->num_seccion }}</option> 
                                        @endforeach
                                    </select>
                                    <span class="select-highlight"></span>
                                    <span class="select-bar"></span>
                                    <label class="select-label">Sección</label>
                                </div>
                            @else
                                <h6 class="uk-margin-remove uk-text-bold">No hay secciones disponibles</h6>
                            @endif

                            <h6 class="uk-text-bold">Datos personales</h6>

                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="nombre" type="text" maxlength="100"/>
                                    <span class="omrs-input-label">Nombre completo</span>
                                </label>
                            </div>
                            <!--Grid Edad, Sexo, Ocupación, Teléfono-->
                            <div uk-grid>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input required name="apellido_paterno" type="text" maxlength="100"/>
                                            <span class="omrs-input-label">Apellido paterno</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="apellido_materno" type="text" maxlength="100"/>
                                            <span class="omrs-input-label">Apellido materno (opcional)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input name="correo_electronico" type="email" maxlength="320"/>
                                    <span class="omrs-input-label">Correo electrónico</span>
                                </label>
                            </div>
                            <div uk-grid class="uk-margin">
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input required name="fecha_de_nacimiento" type="date" min="1900-01-01"/>
                                            <span class="omrs-input-label">Fecha de nacimiento</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="select">
                                        <select class="select-text" required name="sexo">
                                            <option value="" disabled selected></option>
                                            <option value="h">Hombre</option>
                                            <option value="m">Mujer</option> 
                                        </select>
                                        <span class="select-highlight"></span>
                                        <span class="select-bar"></span>
                                        <label class="select-label">Sexo</label>
                                    </div>
                                </div>
                            </div>
                            <div uk-grid class="uk-margin">
                                <div class="uk-width-1-2@m">
                                    <div class="select">
                                        <select class="select-text" required name="trabajo">
                                            @foreach ($ocupaciones as $ocupacion)
                                                <option value="{{ $ocupacion->nombre }}">{{ $ocupacion->nombre }}</option> 
                                            @endforeach
                                        </select>
                                        <span class="select-highlight"></span>
                                        <span class="select-bar"></span>
                                        <label class="select-label">Ocupación</label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        {{-- pattern="[0-9]{3}[ -][0-9]{3}[ -][0-9]{4}" title="El número de teléfono debe tener 3 dígitos, un espacio o un guión, los siguientes 3 dígitos, espacio o guión, y los últimos 3 dígitos; o puede escribir el número sin espacios." --}}
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="telefono" type="text" maxlength="15" pattern="[0-9]{3}[ -]*[0-9]{3}[ -]*[0-9]{4}" title="El número de teléfono debe tener 3 dígitos, un espacio o un guión, los siguientes 3 dígitos, espacio o guión, y los últimos 3 dígitos; o puede escribir el número de 10 dígitos sin espacios."/>
                                            <span class="omrs-input-label">Teléfono</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="select">
                                <select class="select-text" name="estado_civil">
                                    <option value="" disabled selected></option>
                                    <option value="soltero">Soltero/a</option>
                                    <option value="casado">Casado/a</option>
                                    <option value="unionl">Unión libre o unión de hecho</option> 
                                    <option value="separado">Separado/a</option> 
                                    <option value="divorciado">Divorciado/a</option> 
                                    <option value="viudo">Viudo/a</option> 
                                </select>
                                <span class="select-highlight"></span>
                                <span class="select-bar"></span>
                                <label class="select-label">Estado Civil (opcional)</label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="clave_elector" type="text" maxlength="20" minlength="16"/>
                                    <span class="omrs-input-label">Clave de elector</span>
                                </label>
                            </div>
                                                        
                            <h6 class="uk-text-bold">Datos del domicilio</h6>


                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="colonia" type="text" maxlength="100"/>
                                    <span class="omrs-input-label">Colonia</span>
                                </label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input name="calle" type="text" maxlength="100"/>
                                    <span class="omrs-input-label">Calle (opcional)</span>
                                </label>
                            </div>
                            <div uk-grid>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="num_exterior" type="text" maxlength="10"/>
                                            <span class="omrs-input-label">Número exterior (opcional)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="num_interior" type="text" maxlength="10"/>
                                            <span class="omrs-input-label">Número interior (opcional)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="CP" type="text" maxlength="5" minlength="5"/>
                                    <span class="omrs-input-label">Código postal</span>
                                </label>
                            </div>
                            <div uk-grid>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="facebook" type="text" maxlength="50"/>
                                            <span class="omrs-input-label">Facebook (opcional)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="omrs-input-group uk-margin">
                                        <label class="omrs-input-underlined input-outlined">
                                            <input name="twitter" type="text" maxlength="50"/>
                                            <span class="omrs-input-label">Twitter (opcional)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Lado derecho -->
                        <div class="uk-width-1-2@m">
                            <h6 class="uk-text-bold">Fotos</h6>
                            {{--
                            <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                                <span class="uk-text-middle">Foto de credencial anverso</span>
                                <span uk-icon="icon: cloud-upload"></span>
                                <div uk-form-custom>
                                    <input type="file" required name="foto_anverso"/>
                                    <span class="uk-link">Selecciona una</span>
                                </div>
                            </div>

                            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>

                            <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                                <span class="uk-text-middle">Foto de credencial inverso</span>
                                <span uk-icon="icon: cloud-upload"></span>
                                <div uk-form-custom>
                                    <input type="file" required name="foto_inverso"/>
                                    <span class="uk-link">Selecciona una</span>
                                </div>
                            </div>
                            --}}
                            <p>Foto de credencial anverso</p>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="foto_anverso" type="file"/>
                                    <span class="omrs-input-label"></span>
                                </label>
                            </div>
                            <p>Foto de credencial inverso</p>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="foto_inverso" type="file"/>
                                    <span class="omrs-input-label"></span>
                                </label>
                            </div>
                            <p>Foto de elector (opcional)</p>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input name="foto_de_elector" type="file"/>
                                    <span class="omrs-input-label"></span>
                                </label>
                            </div>
                            <p>Foto de firma de elector (opcional)</p>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input name="foto_de_firma" type="file"/>
                                    <span class="omrs-input-label"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                </form>
                <p class="uk-text-muted">
                    El ciudadano involucrado será notificado sobre la carga de su
                    información personal al sistema iElect brindandole transparencia
                    total y la posibilidad de solicitud de eliminación de la misma.
                </p>
                <p class="uk-position-medium uk-position-bottom-left">
                    <button class="uk-button uk-button-default uk-modal-close uk-text-danger uk-text-bold" type="button">
                        Eliminar
                    </button>
                </p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button class="uk-button uk-button-primary" id="btnEnviar" type="submit">
                        Enviar
                    </button>
                </p>
            </div>
        </form>
    </div>
</div>

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">Simpatizantes</h3>
                <p class="uk-margin-left" style="margin-top: 0">Total: {{ $simpatizantes->count() }} simpatizantes</p>
            </div>

            <div>
                <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                    style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-simp">
                    Agregar simpatizante
                    <span uk-icon="icon: plus" class="uk-margin-left"></span>
                </button>
            </div>
            <div class="uk-hidden@m">
                <div class="omrs-input-group">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                <button class="uk-button uk-button-default uk-background-muted uk-margin-right" style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-simp">
                    Agregar simpatizante
                    <span uk-icon="icon: plus" class="uk-margin-left"></span>
                </button>
                <div class="uk-visible@m">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input required />
                            <span class="input-trail-icon" uk-icon="search"></span>
                        </label>
                    </div>
                </div>
            </div>

            <a class="uk-padding-small" href="{{route('simpatizantes_eliminar')}}">Solicitudes de eliminación</a>

            @if ($simpatizantes && count($simpatizantes) > 0)
            <h5 class="uk-text-bold uk-padding-small" style="margin: 0">Información por sección</h5>
            <!-- Tabla -->
            <div class="uk-overflow-auto uk-padding-small">
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead class="uk-background-muted">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            <th>Ocupación</th>
                            <th>Sección electoral</th>
                            <th>Clave de elecetor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simpatizantes as $simpatizante)
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>{{ $simpatizante->nombre." ".$simpatizante->apellido_p." ".$simpatizante->apellido_m }}</td>
                                <td>{{ $simpatizante->sexo }}</td>
                                <td>{{ \Carbon\Carbon::parse($simpatizante->fecha_nac)->diff(\Carbon\Carbon::now())->format('%y años, %m meses y %d dias') }}</td>
                                <td>{{ $simpatizante->job->nombre }}</td>
                                <td>{{ $simpatizante->section->num_seccion }}</td>
                                <td>{{ $simpatizante->clave_elector }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $simpatizantes->links() !!}
            </div>
            @else
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">No hay simpatizantes registrados</h5>
            @endif
        </div>
    </div>

    <!-- Card de SIMPATIZANTES -->
    <div class="uk-card uk-card-default uk-padding-small">
        <div class="uk-card-title">

        </div>

    </div>

    <script>
        //ajax del form de nuevo
        $("#form-nuevo-simp").bind("submit",function(){
            // Capturamnos el boton de envío
            var btnEnviar = $("#btnEnviar");

            $.ajax({
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
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
                    UIkit.notification({
                        message: '<span uk-icon=\'icon: check\'></span> Simpatizante registrado con éxito!',
                        status: 'success',
                        pos: 'top-center',
                        timeout: 2000
                    });
                    $('#errors').css('display', 'none');
                    setTimeout(
                    function()
                    {
                        window.location.reload(true);
                    }, 2000);
                },
                error: function(data){
                    console.log(data);
                    // $('#success').css('display', 'none');
                    btnEnviar.removeAttr("disabled");
                    $('#errors').css('display', 'block');
                    var errors = data.responseJSON.errors;
                    var errorsContainer = $('#errors');
                    errorsContainer.innerHTML = '';
                    var errorsList = '';
                    // for (var i = 0; i < errors.length; i++) {
                    // //     //if(errors[i].redirect)
                    // //         //window.location.href = window.location.origin + '/logout'
                        
                    //     errorsList += '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'+ errors[i].errors +'</p></div>';
                    // }
                    for(var key in errors){
                        var obj=errors[key];
                        console.log(obj);
                        for(var yek in obj){
                            var error=obj[yek];
                            console.log(error);
                            errorsList += '<div><a></a><p>'+ error +'</p></div>';
                        }
                    }
                    errorsContainer.html(errorsList);
                    UIkit.notification({
                        message: '<span uk-icon=\'icon: close\'></span>Problemas al tratar de enviar el formulario, inténtelo más tarde.',
                        status: 'danger',
                        pos: 'top-center',
                        timeout: 2000
                    });
                }
            });
            // Nos permite cancelar el envio del formulario
            return false;
        });
    </script>

<script>

    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: '',
        multiple: true,

        beforeSend: function (environment) {
            console.log('beforeSend', arguments);

            // The environment object can still be modified here. 
            // var {data, method, headers, xhr, responseType} = environment;

        },
        beforeAll: function () {
            console.log('beforeAll', arguments);
        },
        load: function () {
            console.log('load', arguments);
        },
        error: function () {
            console.log('error', arguments);
        },
        complete: function () {
            console.log('complete', arguments);
        },

        loadStart: function (e) {
            console.log('loadStart', arguments);

            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },

        progress: function (e) {
            console.log('progress', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        loadEnd: function (e) {
            console.log('loadEnd', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        completeAll: function () {
            console.log('completeAll', arguments);

            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);

            alert('Upload Completed');
        }

    });

</script>
</div>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
    UIkit.modal("#modal-datos-simp").toggle();
}
@endsection