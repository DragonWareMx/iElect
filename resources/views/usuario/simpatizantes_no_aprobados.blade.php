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

@if (Auth::user()->roles[0]->name == 'Agente')
<!-- Modal Datos Simpatizante -->
<div id="modal-datos-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title" id="simp_edit_id">Simpatizante #</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-text-center">
                        <img id="simp_edit_foto" class="profile-pic uk-border-circle"
                            src="{{asset('img/icons/default.png')}}" width="150" height="150" alt="Border circle"
                            uk-img />
                    </div>
                    <div class="uk-text-bold">Nombre</div>
                    <div id="simp_edit_nombre">José Agustín Aguilar Solórzano</div>
                    <br />
                    <div class="uk-text-bold">Domicilio</div>
                    <div id="simp_edit_domicilio">Morelia, Centro #442</div>
                    <br />
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Edad</div>
                            <div id="simp_edit_edad">32</div>
                            <br />
                            <div class="uk-text-bold">Ocupación</div>
                            <div id="simp_edit_job">Escritor</div>
                            <br />
                            <div class="uk-text-bold">Correo electrónico</div>
                            <div id="simp_edit_email">correo@ejemplo.com</div>
                            <br />
                            <div class="uk-text-bold">Sección electoral</div>
                            <div id="simp_edit_section">#</div>
                            <br />
                            <div class="uk-text-bold">Clave de elector</div>
                            <div id="simp_edit_celector">#########</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Sexo</div>
                            <div id="simp_edit_genero">Masculino</div>
                            <br />
                            <div class="uk-text-bold">Teléfono</div>
                            <div id="simp_edit_tel">1234567891</div>
                            <br />
                            <div class="uk-text-bold">Facebook</div>
                            <div id="simp_edit_face">link</div>
                            <br />
                            <div class="uk-text-bold">Twitter</div>
                            <div id="simp_edit_tw">link</div>
                            <br />
                            <div class="uk-text-bold">Brigadista</div>
                            <div id="simp_edit_brigadista">#######</div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="uk-text-bold" id="simp_edit_front_t">Foto de credencial anverso</div>
                    <img id="simp_edit_front" class="uk-margin-bottom" src="img/test/ine_front.jpg" width="75%"
                        height="auto" alt="" uk-img />
                    <div class="uk-text-bold" id="simp_edit_back_t">Foto de credencial inverso</div>
                    <img id="simp_edit_back" class="uk-margin-bottom" src="img/test/ine_back.jpg" width="75%"
                        height="auto" alt="" uk-img />
                    <div class="uk-text-bold" id="simp_edit_firma_t">Foto de firma</div>
                    <img id="simp_edit_firma" class="uk-margin-bottom" src="img/test/ine_back.jpg" width="75%"
                        height="auto" alt="" uk-img />
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (Auth::user()->roles[0]->name == 'Administrador')
<!-- Modal Datos Simpatizante -->
<div id="modal-datos-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title" id="simp_edit_id">Simpatizante #</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-text-center">
                        <img id="simp_edit_foto" class="profile-pic uk-border-circle"
                            src="{{asset('img/icons/default.png')}}" width="150" height="150" alt="Border circle"
                            uk-img />
                    </div>
                    <div class="uk-text-bold">Nombre</div>
                    <div id="simp_edit_nombre">José Agustín Aguilar Solórzano</div>
                    <br />
                    <div class="uk-text-bold">Domicilio</div>
                    <div id="simp_edit_domicilio">Morelia, Centro #442</div>
                    <br />
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Edad</div>
                            <div id="simp_edit_edad">32</div>
                            <br />
                            <div class="uk-text-bold">Ocupación</div>
                            <div id="simp_edit_job">Escritor</div>
                            <br />
                            <div class="uk-text-bold">Correo electrónico</div>
                            <div id="simp_edit_email">correo@ejemplo.com</div>
                            <br />
                            <div class="uk-text-bold">Sección electoral</div>
                            <div id="simp_edit_section">#</div>
                            <br />
                            <div class="uk-text-bold">Clave de elector</div>
                            <div id="simp_edit_celector">#########</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Sexo</div>
                            <div id="simp_edit_genero">Masculino</div>
                            <br />
                            <div class="uk-text-bold">Teléfono</div>
                            <div id="simp_edit_tel">1234567891</div>
                            <br />
                            <div class="uk-text-bold">Facebook</div>
                            <div id="simp_edit_face">link</div>
                            <br />
                            <div class="uk-text-bold">Twitter</div>
                            <div id="simp_edit_tw">link</div>
                            <br />
                            <div class="uk-text-bold">Brigadista</div>
                            <div id="simp_edit_brigadista">#######</div>
                            <br />
                            <div class="uk-text-bold">Campaña</div>
                            <div id="simp_edit_campa">#######</div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="uk-text-bold" id="simp_edit_front_t">Foto de credencial anverso</div>
                    <img id="simp_edit_front" class="uk-margin-bottom" src="img/test/ine_front.jpg" width="75%"
                        height="auto" alt="" uk-img />
                    <div class="uk-text-bold" id="simp_edit_back_t">Foto de credencial inverso</div>
                    <img id="simp_edit_back" class="uk-margin-bottom" src="img/test/ine_back.jpg" width="75%"
                        height="auto" alt="" uk-img />
                    <div class="uk-text-bold" id="simp_edit_firma_t">Foto de firma</div>
                    <img id="simp_edit_firma" class="uk-margin-bottom" src="img/test/ine_back.jpg" width="75%"
                        height="auto" alt="" uk-img />
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">Simpatizantes</h3>
                <p class="uk-margin-left" style="margin-top: 0">Total: {{ $totalNA }} simpatizantes no aprobados</p>
                @if(isset($totalb))
                <p class="uk-margin-left" style="margin-top: 0">Total búsqueda: {{ $totalb }} simpatizantes</p>
                @endif
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
                @if (Auth::user()->roles[0]->name == 'Agente' || Auth::user()->roles[0]->name == 'Administrador')
                <div class="uk-visible@m">
                    <div class="omrs-input-group">
                        <form id="form-buscador" action="{{ route('simpatizantes_no_aprobados') }}" method="get">
                            <label class="omrs-input-underlined input-outlined input-trail-icon">
                                <input name="busc" type="text" maxlength="100" @if(isset($busqueda)) value="{{$busqueda}}"@endif/>
                                <span class="input-trail-icon" uk-icon="search"></span>
                            </label>
                        </form>
                    </div>
                </div>
                @endif
            </div>

            @if (Auth::user()->roles[0]->name == 'Agente')
                <a class="uk-padding-small" href="{{ route('simpatizantes') }}">Ver simpatizantes aprobados</a>
                @if ($simpatizantes && count($simpatizantes) > 0)
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">Información por sección</h5>
                <!-- Tabla -->
                <div class="uk-overflow-auto uk-padding-small">
                    <form id="form-aprobar" class="uk-modal-body" action="{{ route('aprobar-simpatizante') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div id="errors" class="uk-alert-danger" uk-alert style="display:none;"></div>
                        <div class="uk-flex">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Ocupación</th>
                                        <th>Sección</th>
                                        <th>Clave de elecetor</th>
                                        <th>Selección</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-simps">
                                    @foreach ($simpatizantes as $simpatizante)
                                    <tr data-id="{{$simpatizante->id}}">
                                        <td>#{{ $simpatizante->id }}</td>
                                        <td>{{ $simpatizante->nombre." ".$simpatizante->apellido_p." ".$simpatizante->apellido_m }}
                                        </td>
                                        <td>{{ $simpatizante->sexo }}</td>
                                        <td>{{ \Carbon\Carbon::parse($simpatizante->fecha_nac)->diff(\Carbon\Carbon::now())->format('%y años') }}
                                        </td>
                                        <td>{{ $simpatizante->job->nombre }}</td>
                                        <td>{{ $simpatizante->section->num_seccion }}</td>
                                        <td>{{ $simpatizante->clave_elector }}</td>
                                        <td><input type="checkbox" name="seleccion[]" value="{{ $simpatizante->id }}"></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="checkbox" onClick="toggle(this)"> Seleccionar todos</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="uk-button uk-button-primary" id="btnEnviar" type="submit">
                            Aprobar seleccionados
                        </button>
                    </form>
                    {!! $simpatizantes->links() !!}
                </div>
                @else
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">No hay simpatizantes no aprobados</h5>
                @endif
            @endif
            @if (Auth::user()->roles[0]->name == 'Administrador')
            <a class="uk-padding-small" href="{{ route('simpatizantes') }}">Ver simpatizantes aprobados</a>
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
                                <th>Campaña</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-simps">
                            @foreach ($simpatizantes as $simpatizante)
                            <tr data-id="{{$simpatizante->id}}">
                                <td>#{{ $simpatizante->id }}</td>
                                <td>{{ $simpatizante->nombre." ".$simpatizante->apellido_p." ".$simpatizante->apellido_m }}
                                </td>
                                <td>{{ $simpatizante->sexo }}</td>
                                <td>{{ \Carbon\Carbon::parse($simpatizante->fecha_nac)->diff(\Carbon\Carbon::now())->format('%y años') }}
                                </td>
                                <td>{{ $simpatizante->job->nombre }}</td>
                                <td>{{ $simpatizante->section->num_seccion }}</td>
                                <td>{{ $simpatizante->clave_elector }}</td>
                                <td>{{ $simpatizante->campaign->name }}</td>
                                <td><p class="">
                                    <a href="{{ route('editar-simpatizante', ['id' =>$simpatizante->id]) }}" class="uk-button uk-button-default" type="button">
                                        Editar
                                    </a>
                                </p></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $simpatizantes->links() !!}
                </div>
                @else
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">No hay simpatizantes registrados</h5>
                @endif
            @endif
        </div>
    </div>

    @if (Auth::user()->roles[0]->name == 'Agente')
    {{-- SCRIPT VER DATOS --}}
    <script>
        function _calculateAge(birthday) { // birthday is a date
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }

        function toggle(source) {
            checkboxes = document.getElementsByName('seleccion[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        $(document).ready(function () {
            var simps={!! json_encode($simpatizantes); !!};
            var simps=simps['data'];

            $('#tabla-simps tr').click(function(e){
                if(e.target.cellIndex === 7 || e.target.tagName == 'INPUT'){
                    return;
                }
                var id = $(this).data('id');
                for(var key in simps){
                    var obj=simps[key];
                    if(obj["id"] == id){
                        break;
                    }
                }
                //console.log(obj);
                //falta la foto principal
                $('#simp_edit_id').html('Simpatizante ' + obj['id']);
                $('#simp_edit_nombre').html(obj['nombre']+ " " + obj['apellido_p']+ " " + obj['apellido_m']);
                $('#simp_edit_domicilio').html(obj['calle']+ " " + obj['ext_num']+ " " + obj['int_num']+ " " + obj['colonia']+ " " + obj['cp']);
                var d = new Date(obj['fecha_nac']);
                $('#simp_edit_edad').html(_calculateAge(d));
                $('#simp_edit_job').html(obj['job']['nombre']);
                $('#simp_edit_email').html(obj['email']);
                $('#simp_edit_section').html(obj['section']['num_seccion']);
                $('#simp_edit_celector').html(obj['clave_elector']);
                $('#simp_edit_genero').html(obj['sexo'] == 'h' ? "Masculino" : "Femenino" );
                $('#simp_edit_tel').html(obj['telefono']);
                $('#simp_edit_face').html(obj['facebook']);
                $('#simp_edit_tw').html(obj['twitter']);
                //aqui falta lo del brigadista
                $('#simp_edit_brigadista').html(obj['name']);

                //aqui empieza lo de las fotos del ine
                if(obj['credencial_a']){
                    $("#simp_edit_front").attr("src",obj['credencial_a']);
                    $("#simp_edit_front_t").html('Foto de credencial anverso');
                }
                else{
                    $("#simp_edit_front").attr("src","");
                    $("#simp_edit_front_t").html('Sin foto de credencial anverso');
                }
                if(obj['credencial_r']){
                    $("#simp_edit_back").attr("src",obj['credencial_r']);
                    $("#simp_edit_back_t").html('Foto de credencial inverso');
                }
                else{
                    $("#simp_edit_back").attr("src",obj['credencial_a']);
                    $("#simp_edit_back_t").html('Sin foto de credencial inverso');
                }

                //aqui empieza lo de las fotos del simp
                if(obj['foto_elector']){
                    $("#simp_edit_foto").attr("src",obj['foto_elector']);
                }
                else{
                    $("#simp_edit_foto").attr("src","{{asset('img/icons/default.png')}}");
                }
                if(obj['documento']){
                    $("#simp_edit_firma").attr("src",obj['documento']);
                    $("#simp_edit_firma_t").html('Foto de firma');
                }
                else{
                    $("#simp_edit_firma").attr("src","");
                    $("#simp_edit_firma_t").html('Sin foto de firma');
                }
                UIkit.modal("#modal-datos-simp").toggle();
            });
        });
    </script>
    {{-- SCRIPT AGREGAR --}}
    <script>
        //ajax del form de nuevo
        $("#form-aprobar").bind("submit",function(){
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
                    UIkit.notification({
                        message: '<span uk-icon=\'icon: check\'></span> Simpatizantes aprobados con éxito!',
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
    @endif

    @if (Auth::user()->roles[0]->name == 'Administrador')
    {{-- SCRIPT VER DATOS --}}
    <script>
        function _calculateAge(birthday) { // birthday is a date
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }

        $(document).ready(function () {
            var simps={!! json_encode($simpatizantes); !!};
            var simps=simps['data'];

            $('#tabla-simps tr').click(function(){
                var id = $(this).data('id');
                for(var key in simps){
                    var obj=simps[key];
                    if(obj["id"] == id){
                        break;
                    }
                }
                //console.log(obj);
                //falta la foto principal
                $('#simp_edit_id').html('Simpatizante ' + obj['id']);
                $('#simp_edit_nombre').html(obj['nombre']+ " " + obj['apellido_p']+ " " + obj['apellido_m']);
                $('#simp_edit_domicilio').html(obj['calle']+ " " + obj['ext_num']+ " " + obj['int_num']+ " " + obj['colonia']+ " " + obj['cp']);
                var d = new Date(obj['fecha_nac']);
                $('#simp_edit_edad').html(_calculateAge(d));
                $('#simp_edit_job').html(obj['job']['nombre']);
                $('#simp_edit_email').html(obj['email']);
                $('#simp_edit_section').html(obj['section']['num_seccion']);
                $('#simp_edit_celector').html(obj['clave_elector']);
                $('#simp_edit_genero').html(obj['sexo'] == 'h' ? "Masculino" : "Femenino" );
                $('#simp_edit_tel').html(obj['telefono']);
                $('#simp_edit_face').html(obj['facebook']);
                $('#simp_edit_tw').html(obj['twitter']);
                //aqui falta lo del brigadista
                $('#simp_edit_brigadista').html(obj['name']);
                $('#simp_edit_campa').html(obj['campaign']['name']);

                //aqui empieza lo de las fotos del ine
                if(obj['credencial_a']){
                    $("#simp_edit_front").attr("src",obj['credencial_a']);
                    $("#simp_edit_front_t").html('Foto de credencial anverso');
                }
                else{
                    $("#simp_edit_front").attr("src","");
                    $("#simp_edit_front_t").html('Sin foto de credencial anverso');
                }
                if(obj['credencial_r']){
                    $("#simp_edit_back").attr("src",obj['credencial_r']);
                    $("#simp_edit_back_t").html('Foto de credencial inverso');
                }
                else{
                    $("#simp_edit_back").attr("src",obj['credencial_a']);
                    $("#simp_edit_back_t").html('Sin foto de credencial inverso');
                }

                //aqui empieza lo de las fotos del simp
                if(obj['foto_elector']){
                    $("#simp_edit_foto").attr("src",obj['foto_elector']);
                }
                else{
                    $("#simp_edit_foto").attr("src","{{asset('img/icons/default.png')}}");
                }
                if(obj['documento']){
                    $("#simp_edit_firma").attr("src",obj['documento']);
                    $("#simp_edit_firma_t").html('Foto de firma');
                }
                else{
                    $("#simp_edit_firma").attr("src","");
                    $("#simp_edit_firma_t").html('Sin foto de firma');
                }
                UIkit.modal("#modal-datos-simp").toggle();
            });
        });
    </script>
    @endif
    @endsection

    @section('scripts')

    @endsection