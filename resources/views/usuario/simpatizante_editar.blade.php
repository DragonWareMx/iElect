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

@if (Auth::user()->roles[0]->name == 'Administrador')
{{-- MODAL AGREGAR SIMPATIZANTE --}}
<a class="uk-padding-small" href="{{ route('simpatizantes') }}">Ver simpatizantes</a>
<button class="uk-modal-close-default" type="button" uk-close></button>
<div class="uk-modal-header">
    <h2 class="uk-modal-title">Editar simpatizante</h2>
</div>
{{-- enctype="multipart/form-data" --}}
<form id="form-editar-simp" class="uk-modal-body" action="{{ route('update-simpatizante',['id'=>Crypt::encrypt($simpatizante->id)]) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div id="errors" class="uk-alert-danger" uk-alert style="display:none;"></div>
    <div uk-grid>
        <!-- Lado izquierdo -->
        <div class="uk-width-1-2@m">
            @if (!is_null($secciones) && count($secciones) > 0)
            <h6 class="uk-text-bold">Sección</h6>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input required list="secciones" name="seccion" value="{{ $simpatizante->section->num_seccion }}"/>
                    <datalist class="select-text" required id="secciones">
                        @foreach ($secciones as $seccion)
                            <option value="{{ $seccion->num_seccion }}">
                        @endforeach
                    </datalist>
                </label>
            </div>
            @else
            <h6 class="uk-margin-remove uk-text-bold">No hay secciones disponibles</h6>
            @endif

            <h6 class="uk-text-bold">Datos personales</h6>

            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input required name="nombre" type="text" maxlength="100" value="{{$simpatizante->nombre}}"/>
                    <span class="omrs-input-label">Nombre completo</span>
                </label>
            </div>
            <!--Grid Edad, Sexo, Ocupación, Teléfono-->
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required name="apellido_paterno" type="text" maxlength="100" value="{{$simpatizante->apellido_p}}"/>
                            <span class="omrs-input-label">Apellido paterno</span>
                        </label>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input name="apellido_materno" type="text" maxlength="100" value="{{$simpatizante->apellido_m}}"/>
                            <span class="omrs-input-label">Apellido materno (opcional)</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="correo_electronico" type="email" maxlength="320" value="{{$simpatizante->email}}"/>
                    <span class="omrs-input-label">Correo electrónico</span>
                </label>
            </div>
            <div uk-grid class="uk-margin">
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required name="fecha_de_nacimiento" type="date" min="1900-01-01" value="{{$simpatizante->fecha_nac}}"/>
                            <span class="omrs-input-label">Fecha de nacimiento</span>
                        </label>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="select">
                        <select class="select-text" required name="sexo">
                            <option value="" disabled selected></option>
                            <option value="h" @if($simpatizante->sexo == 'h') selected @endif>Hombre</option>
                            <option value="m" @if($simpatizante->sexo == 'm') selected @endif>Mujer</option>
                        </select>
                        <span class="select-highlight"></span>
                        <span class="select-bar"></span>
                        <label class="select-label">Sexo</label>
                    </div>
                </div>
            </div>
            <div uk-grid class="uk-margin">
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required name="trabajo" list="trabajos" value="{{ $simpatizante->job->nombre }}"/>
                            <span class="omrs-input-label">Ocupación</span>
                            <datalist id="trabajos">
                                @foreach ($ocupaciones as $ocupacion)
                                    <option value="{{ $ocupacion->nombre }}">
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        {{-- pattern="[0-9]{3}[ -][0-9]{3}[ -][0-9]{4}" title="El número de teléfono debe tener 3 dígitos, un espacio o un guión, los siguientes 3 dígitos, espacio o guión, y los últimos 3 dígitos; o puede escribir el número sin espacios." --}}
                        <label class="omrs-input-underlined input-outlined">
                            <input name="telefono" type="text" maxlength="15"
                                pattern="[0-9]{3}[ -]{0,3}[0-9]{3}[ -]{0,3}[0-9]{4}"
                                title="El número de teléfono debe tener 3 dígitos, un espacio o un guión, los siguientes 3 dígitos, espacio o guión, y los últimos 3 dígitos; o puede escribir el número de 10 dígitos sin espacios."
                                value="{{$simpatizante->telefono}}"/>
                            <span class="omrs-input-label">Teléfono</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="select">
                <select class="select-text" name="estado_civil">
                    <option value="" disabled></option>
                    <option value="soltero" @if($simpatizante->edo_civil == 'soltero') selected @endif>Soltero/a</option>
                    <option value="casado" @if($simpatizante->edo_civil == 'casado') selected @endif>Casado/a</option>
                    <option value="unionl" @if($simpatizante->edo_civil == 'unionl') selected @endif>Unión libre o unión de hecho</option>
                    <option value="separado" @if($simpatizante->edo_civil == 'separado') selected @endif>Separado/a</option>
                    <option value="divorciado" @if($simpatizante->edo_civil == 'divorciado') selected @endif>Divorciado/a</option>
                    <option value="viudo" @if($simpatizante->edo_civil == 'viudo') selected @endif>Viudo/a</option>
                </select>
                <span class="select-highlight"></span>
                <span class="select-bar"></span>
                <label class="select-label">Estado Civil (opcional)</label>
            </div>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input required name="clave_elector" type="text" maxlength="20" minlength="16" value="{{$simpatizante->clave_elector}}"/>
                    <span class="omrs-input-label">Clave de elector</span>
                </label>
            </div>

            <h6 class="uk-text-bold">Datos del domicilio</h6>


            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input required name="colonia" type="text" maxlength="100" value="{{$simpatizante->colonia}}"/>
                    <span class="omrs-input-label">Colonia</span>
                </label>
            </div>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="calle" type="text" maxlength="100" value="{{$simpatizante->calle}}"/>
                    <span class="omrs-input-label">Calle (opcional)</span>
                </label>
            </div>
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input name="num_exterior" type="text" maxlength="10" value="{{$simpatizante->ext_num}}"/>
                            <span class="omrs-input-label">Número exterior (opcional)</span>
                        </label>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input name="num_interior" type="text" maxlength="10" value="{{$simpatizante->int_num}}"/>
                            <span class="omrs-input-label">Número interior (opcional)</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input required name="CP" type="text" maxlength="5" minlength="5" value="{{$simpatizante->cp}}"/>
                    <span class="omrs-input-label">Código postal</span>
                </label>
            </div>
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input name="facebook" type="text" maxlength="50" value="{{$simpatizante->facebook}}"/>
                            <span class="omrs-input-label">Facebook (opcional)</span>
                        </label>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input name="twitter" type="text" maxlength="50" value="{{$simpatizante->twitter}}"/>
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
            @if ($simpatizante->credencial_a)
            <p>El simpatizante ya tiene la foto: {{ $simpatizante->getRawOriginal('credencial_a') }}</p>   
            @endif
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="foto_anverso" type="file" accept="image/*"/>
                    <span class="omrs-input-label"></span>
                </label>
                <p>¿Desea eliminar o sustituir la imagen con la seleccionada?</p>
                <input name="el_foto_anverso" type="checkbox" value="1"/>
            </div>
            <p>Foto de credencial inverso</p>
            @if ($simpatizante->credencial_r)
            <p>El simpatizante ya tiene la foto: {{ $simpatizante->getRawOriginal('credencial_r') }}</p>   
            @endif
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="foto_inverso" type="file" accept="image/*"/>
                    <span class="omrs-input-label"></span>
                </label>
                <p>¿Desea eliminar o sustituir la imagen con la seleccionada?</p>
                <input name="el_foto_inverso" type="checkbox" value="1"/>
            </div>
            <p>Foto de elector (opcional)</p>
            @if ($simpatizante->foto_elector)
            <p>El simpatizante ya tiene la foto: {{ $simpatizante->getRawOriginal('foto_elector') }}</p>   
            @endif
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="foto_de_elector" type="file" accept="image/*"/>
                    <span class="omrs-input-label"></span>
                </label>
                <p>¿Desea eliminar o sustituir la imagen con la seleccionada?</p>
                <input name="el_foto_elector" type="checkbox" value="1"/>
            </div>
            <p>Foto de firma de elector (opcional)</p>
            @if ($simpatizante->documento)
            <p>El simpatizante ya tiene la foto: {{ $simpatizante->getRawOriginal('documento') }}</p>   
            @endif
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="foto_de_firma" type="file" accept="image/*"/>
                    <span class="omrs-input-label"></span>
                </label>
                <p>¿Desea eliminar o sustituir la imagen con la seleccionada?</p>
                <input name="el_foto_firma" type="checkbox" value="1"/>
            </div>
            <p>Aprobado</p>
            <div class="omrs-input-group uk-margin">
                <label class="omrs-input-underlined input-outlined">
                    <input name="aprobado" type="checkbox" value="1" @if($simpatizante->aprobado) checked @endif/>
                    <span class="omrs-input-label"></span>
                </label>
            </div>
        </div>
    </div>
    <p class="uk-text-muted">
        El ciudadano involucrado será notificado sobre la carga de su
        información personal al sistema iElect brindandole transparencia
        total y la posibilidad de solicitud de eliminación de la misma.
    </p>
    <p class="uk-text-left">
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
</form>
@endif

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
</div>


    @if (Auth::user()->roles[0]->name == 'Administrador')
    {{-- SCRIPT AGREGAR --}}
    <script>
        //ajax del form de nuevo
        $("#form-editar-simp").bind("submit",function(){
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
                        message: '<span uk-icon=\'icon: check\'></span> Simpatizante editado con éxito!',
                        status: 'success',
                        pos: 'top-center',
                        timeout: 2000
                    });
                    $('#errors').css('display', 'none');
                    setTimeout(
                    function()
                    {
                        window.location.href = '/simpatizantes';
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
    @endif

    @endsection

    @section('scripts')

    @endsection