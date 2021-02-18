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

@if (Auth::user()->roles[0]->name == 'Brigadista')
{{-- MODAL AGREGAR SIMPATIZANTE --}}
<div id="modal-agregar-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Agregar simpatizante</h2>
        </div>
        {{-- enctype="multipart/form-data" --}}
        <form id="form-nuevo-simp" class="uk-modal-body" action="{{ route('agregar-simpatizante') }}" method="POST"
            enctype="multipart/form-data">
            <div class="uk-modal-body">
                @csrf
                <div id="errors" class="uk-alert-danger" uk-alert style="display:none;"></div>
                <div uk-grid>
                    <!-- Lado izquierdo -->
                    <div class="uk-width-1-2@m">
                        {{--<!-- Avatar -->
                            <div class="avatar-wrapper uk-margin-bottom">
                                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}"
                            width="200"
                            height="200" alt="Border circle" />
                            <div class="upload-text">
                                Editar foto
                                <span class="uk-margin-small-left" uk-icon="upload"></span>
                            </div>
                        </div>
                        --}}

                        @if (!is_null($secciones) && count($secciones) > 0)
                        <h6 class="uk-text-bold">Sección</h6>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input required list="secciones" name="seccion" />
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
                                <input required name="nombre" type="text" maxlength="100" />
                                <span class="omrs-input-label">Nombre completo</span>
                            </label>
                        </div>
                        <!--Grid Edad, Sexo, Ocupación, Teléfono-->
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required name="apellido_paterno" type="text" maxlength="100" />
                                        <span class="omrs-input-label">Apellido paterno</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input name="apellido_materno" type="text" maxlength="100" />
                                        <span class="omrs-input-label">Apellido materno (opcional)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input name="correo_electronico" type="email" maxlength="320" />
                                <span class="omrs-input-label">Correo electrónico</span>
                            </label>
                        </div>
                        <div uk-grid class="uk-margin">
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required name="fecha_de_nacimiento" type="date" min="1900-01-01" />
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
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required name="trabajo" list="trabajos"/>
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
                                            title="El número de teléfono debe tener 3 dígitos, un espacio o un guión, los siguientes 3 dígitos, espacio o guión, y los últimos 3 dígitos; o puede escribir el número de 10 dígitos sin espacios." />
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
                                <input required name="clave_elector" type="text" maxlength="20" minlength="16" />
                                <span class="omrs-input-label">Clave de elector</span>
                            </label>
                        </div>

                        <h6 class="uk-text-bold">Datos del domicilio</h6>


                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input required name="colonia" type="text" maxlength="100" />
                                <span class="omrs-input-label">Colonia</span>
                            </label>
                        </div>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input name="calle" type="text" maxlength="100" />
                                <span class="omrs-input-label">Calle (opcional)</span>
                            </label>
                        </div>
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input name="num_exterior" type="text" maxlength="10" />
                                        <span class="omrs-input-label">Número exterior (opcional)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input name="num_interior" type="text" maxlength="10" />
                                        <span class="omrs-input-label">Número interior (opcional)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input required name="CP" type="text" maxlength="5" minlength="5" />
                                <span class="omrs-input-label">Código postal</span>
                            </label>
                        </div>
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input name="facebook" type="text" maxlength="50" />
                                        <span class="omrs-input-label">Facebook (opcional)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input name="twitter" type="text" maxlength="50" />
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
                                <input required name="foto_anverso" type="file" accept="image/*"/>
                                <span class="omrs-input-label"></span>
                            </label>
                        </div>
                        <p>Foto de credencial inverso</p>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input required name="foto_inverso" type="file" accept="image/*"/>
                                <span class="omrs-input-label"></span>
                            </label>
                        </div>
                        <p>Foto de elector (opcional)</p>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input name="foto_de_elector" type="file" accept="image/*"/>
                                <span class="omrs-input-label"></span>
                            </label>
                        </div>
                        <p>Foto de firma de elector (opcional)</p>
                        <div class="omrs-input-group uk-margin">
                            <label class="omrs-input-underlined input-outlined">
                                <input name="foto_de_firma" type="file" accept="image/*"/>
                                <span class="omrs-input-label"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <p class="uk-text-muted">
                El ciudadano involucrado será notificado sobre la carga de su
                información personal al sistema iElect brindandole transparencia
                total y la posibilidad de solicitud de eliminación de la misma.
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
    </div>
</div>
@endif

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-wrap uk-flex-middle">
                <h3 class="uk-text-bold">Simpatizantes</h3>
                <p class="uk-margin-left" style="margin-top: 0">Total: {{ $total }} simpatizantes</p>
                <p class="uk-margin-left" style="margin-top: 0">Total: {{ $totalNA }} simpatizantes no aprobados</p>

                @if(isset($totalb))
                <p class="uk-margin-left" style="margin-top: 0">Total búsqueda: {{ $totalb }} simpatizantes</p>
                @endif

                @if (Auth::user()->roles[0]->name == 'Agente' || Auth::user()->roles[0]->name == 'Administrador')
                <div class="uk-flex uk-flex-wrap uk-margin-auto-left@s">
                    <div class="omrs-input-group">
                        <form id="form-buscador" action="{{ route('simpatizantes') }}"
                            method="get" style="padding: 0">
                            <label class="omrs-input-underlined input-outlined input-trail-icon">
                                <input name="busc" type="text" maxlength="100" @if(isset($busqueda)) value="{{$busqueda}}" @endif/>
                                <span class="input-trail-icon" uk-icon="search"></span>
                            </label>
                        </form>
                    </div>
                </div>
                @endif

                @if (Auth::user()->roles[0]->name == 'Brigadista')
                    <button class="uk-button uk-button-default uk-background-muted uk-margin-auto-left@s" style="
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-simp">
                        Agregar simpatizante
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                @endif
            </div>

            {{--@if (Auth::user()->roles[0]->name == 'Brigadista')
            <div class="uk-position-small" style="display: flex">
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
            @endif

            <div class="uk-flex uk-flex-wrap" style="display: flex">
                @if (Auth::user()->roles[0]->name == 'Brigadista')
                    <button class="uk-visible@m uk-button uk-button-default uk-background-muted uk-margin-right" style="
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-simp">
                        Agregar simpatizante
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                @endif
            </div>--}}

            @if (Auth::user()->roles[0]->name == 'Agente')
            <a class="uk-padding-small" href="{{ route('simpatizantes_no_aprobados') }}">Ver simpatizantes no aprobados</a>
                @if ($simpatizantes && count($simpatizantes) > 0)
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">Información por sección</h5>
                <!-- Tabla -->
                <div class="uk-overflow-auto uk-padding-small">
                    <form id="form-aprobar" class="uk-modal-body" action="{{ route('mensaje-simpatizante') }}" method="post">
                        @csrf
                        <table class="uk-table uk-table-small uk-table-divider">
                            <thead class="uk-background-muted">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Ocupación</th>
                                    <th>Sección electoral</th>
                                    <th>Clave de elector</th>
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
                                    <td><input type="checkbox" name="seleccion[]" value="{{ $simpatizante->id }}" @if(is_array(old('seleccion')) && in_array($simpatizante->id, old('seleccion'))) checked @endif></td>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required name="asunto" type="text" maxlength="100" value="{{ old('asunto') }}"/>
                                    <span class="omrs-input-label">Asunto</span>
                                </label>
                            </div>
                        </div>
                        <h6 class="uk-text-bold">Mensaje</h6>
                        <textarea class="uk-textarea uk-margin-medium-bottom" required rows="10" name="mensaje" type="text" maxlength="2000">{{ old('mensaje') }}</textarea>
                        <button class="uk-button uk-button-primary" id="btnEnviar" type="submit">
                            Mandar mensaje a simpatizantes seleccionados
                        </button>
                    </form>
                    {!! $simpatizantes->links() !!}
                </div>
                @else
                <h5 class="uk-text-bold uk-padding-small" style="margin: 0">No hay simpatizantes registrados</h5>
                @endif
            @endif
            @if (Auth::user()->roles[0]->name == 'Administrador')
            <a class="uk-padding-small" href="{{ route('simpatizantes_no_aprobados') }}">Ver simpatizantes no aprobados</a>
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
                                    <a href="{{ route('editar-simpatizante', ['id' =>Crypt::encrypt($simpatizante->id)]) }}" class="uk-button uk-button-default" type="button">
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


    @if (Auth::user()->roles[0]->name == 'Brigadista')
    {{-- SCRIPT AGREGAR --}}
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
    @endif

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