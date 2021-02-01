@extends('layouts.layout')

@section('title')
Campañas
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
        <div class="uk-modal-body">
            <div uk-grid>
                <!-- Lado izquierdo -->
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-margin-bottom">
                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200"
                            height="200" alt="Border circle" />
                        <div class="upload-text">
                            Editar foto
                            <span class="uk-margin-small-left" uk-icon="upload"></span>
                        </div>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Nombre completo</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Domicilio</span>
                        </label>
                    </div>
                    <!--Grid Edad, Sexo, Ocupación, Teléfono-->
                    <div uk-grid>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Edad</span>
                                </label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Ocupación</span>
                                </label>
                            </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Sexo</span>
                                </label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Teléfono</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Correo electrónico</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Selección electoral</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Clave de elector</span>
                        </label>
                    </div>
                    <div uk-grid>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Facebook</span>
                                </label>
                            </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Twitter</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lado derecho -->
                <div class="uk-width-1-2@m">
                    <p>Fotografías</p>
                    <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                        <span class="uk-text-middle">Foto de credencial anverso</span>
                        <span uk-icon="icon: cloud-upload"></span>
                        <div uk-form-custom>
                            <input type="file" multiple />
                            <span class="uk-link">Selecciona una</span>
                        </div>
                    </div>

                    <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                    <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                        <span class="uk-text-middle">Foto de credencial inverso</span>
                        <span uk-icon="icon: cloud-upload"></span>
                        <div uk-form-custom>
                            <input type="file" multiple />
                            <span class="uk-link">Selecciona una</span>
                        </div>
                    </div>

                    <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                </div>
            </div>
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
                <button class="uk-button uk-button-primary" type="button">
                    Enviar
                </button>
            </p>
        </div>
    </div>
</div>

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">Campañas</h3>
                <p class="uk-margin-left" style="margin-top: 0">Total: 5879 campañas</p>
            </div>

            <div>
                <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                    style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-simp">
                    Agregar campaña
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
                    Agregar campaña
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

            <!-- Tabla -->
            <div class="uk-overflow-auto uk-padding-small">
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead class="uk-background-muted">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Candidato</th>
                            <th>Puesto</th>
                            <th>Partido Politico</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campanas as $camp)
                        <tr onclick="myFunction(this)">
                            <td>{{$camp->id}}</td>
                            <td>{{$camp->name}}</td>
                            <td>{{$camp->candidato}}</td>
                            <td>{{$camp->position->name}}</td>
                            <td>
                                @foreach ($camp->politic_partie as $partido)
                                @if ($loop->index==0)
                                {{$partido->siglas}}
                                @else
                                , {{$partido->siglas}}
                                @endif
                                @endforeach
                            </td>
                            <td>{{$camp->codigo}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="uk-pagination uk-flex-center" uk-margin>
                    <li>
                        <a href="#"><span uk-pagination-previous></span></a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li class="uk-disabled"><span>...</span></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li class="uk-active"><span>7</span></li>
                    <li><a href="#">8</a></li>
                    <li>
                        <a href="#"><span uk-pagination-next></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Card de SIMPATIZANTES -->
    <div class="uk-card uk-card-default uk-padding-small">
        <div class="uk-card-title">

        </div>

    </div>
</div>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
UIkit.modal("#modal-datos-simp").toggle();
}
@endsection