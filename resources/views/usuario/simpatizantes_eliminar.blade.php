@extends('layouts.layout')

@section('title')
Solicitudes de eliminación
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
                        <div class="uk-text-bold" style="margin-top: 0">Motivo de solicitud de eliminación</div>
                        <div style="margin-top: 0">Detalle del motivo de la solicitud de baja de datos</div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <img class="uk-margin-bottom" data-src="{{asset('img/test/ine_front.jpg')}}" width="75%"
                        height="auto" alt="" uk-img />
                    <img data-src="{{asset('img/test/ine_back.jpg')}}" width="75%" height="auto" alt="" uk-img />
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

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <h3 class="uk-padding-small uk-card-title uk-text-bold">
                <a class="uk-margin-right" href="{{route('simpatizantes')}}" uk-icon="arrow-left"></a>Solicitudes de
                eliminación
            </h3>

            <div class="uk-hidden@m uk-padding-small">
                <div class="omrs-input-group">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m">
                <div class="omrs-input-group">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
            </div>

            <a class="uk-padding-small">Eliminar todo</a>
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
                        <tr onclick="myFunction(this)">
                            <td>#1</td>
                            <td>José Agustín Aguilar Solórzano</td>
                            <td>Masculino</td>
                            <td>32</td>
                            <td>Escritor</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#2</td>
                            <td>Leonardo Daniel López López</td>
                            <td>Masculino</td>
                            <td>21</td>
                            <td>Profesor</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#3</td>
                            <td>Fernando Adrián García Sánchez</td>
                            <td>Masculino</td>
                            <td>18</td>
                            <td>Estudiante</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#4</td>
                            <td>Oscar André Huerta García</td>
                            <td>Masculino</td>
                            <td>57</td>
                            <td>Estudiante</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#5</td>
                            <td>Dulce Gabriela Marín Rendón</td>
                            <td>Femenino</td>
                            <td>47</td>
                            <td>Contratista</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#1</td>
                            <td>José Agustín Aguilar Solórzano</td>
                            <td>Masculino</td>
                            <td>32</td>
                            <td>Escritor</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#2</td>
                            <td>Leonardo Daniel López López</td>
                            <td>Masculino</td>
                            <td>21</td>
                            <td>Profesor</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#3</td>
                            <td>Fernando Adrián García Sánchez</td>
                            <td>Masculino</td>
                            <td>18</td>
                            <td>Estudiante</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#4</td>
                            <td>Oscar André Huerta García</td>
                            <td>Masculino</td>
                            <td>57</td>
                            <td>Estudiante</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
                        <tr onclick="myFunction(this)">
                            <td>#5</td>
                            <td>Dulce Gabriela Marín Rendón</td>
                            <td>Femenino</td>
                            <td>47</td>
                            <td>Contratista</td>
                            <td>#</td>
                            <td>#########</td>
                        </tr>
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
</div>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
UIkit.modal("#modal-datos-simp").toggle();
}
@endsection