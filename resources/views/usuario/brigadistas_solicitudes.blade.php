@extends('layouts.layout')

@section('title')
Solicitudes brigadistas
@endsection

@section('imports')

@endsection

@section('body')
<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">
                    Solicitudes Brigadistas
                </h3>
                <p class="uk-margin-left" style="margin-top: 0 !important">Total: 59 brigadistas</p>
            </div>
            <div class="uk-hidden@m uk-padding-small">
                <div class="omrs-input-group">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                <div class="uk-visible@m">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input required />
                            <span class="input-trail-icon" uk-icon="search"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="uk-padding-small" uk-grid>
                <div class="uk-width-1-2@m">
                    <div uk-grid>
                        <div class="uk-width-1-2@m">
                            <a>Seleccionar todo</a>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-flex-inline uk-align-right@m">
                                <button class="uk-button uk-button-text uk-margin-right uk-text-bold uk-text-danger">
                                    Eliminar
                                </button>
                                <button class="uk-button uk-button-primary">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla Solicitudes brigadistas -->
            <div class="uk-padding-small" uk-grid style="margin-top: 0 !important">
                <div class="uk-width-1-2@m">
                    <!-- Tabla -->
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-small uk-table-divider">
                            <thead class="uk-background-muted">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Fecha de solicitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
                                </tr>
                                <tr onclick="myFunction(this)">
                                    <td>#1</td>
                                    <td>José Agustín Aguilar Solórzano</td>
                                    <td>correo@ejemplo.com</td>
                                    <td>03/01/21</td>
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
    </div>
</div>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
UIkit.modal("#modal-datos-simp").toggle();
}
@endsection