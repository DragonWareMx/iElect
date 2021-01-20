@extends('layouts.layout')

@section('title')
Editar usuario
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-card-title uk-text-bold">
                <a class="uk-margin-right" href="{{route('admin-usuario')}}" uk-icon="arrow-left"></a>Agente
            </h3>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-6@m">
                <!-- Avatar circulo -->
                <div>
                    <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200" height="200"
                        alt="Border circle" />
                </div>
            </div>
            <div class="uk-width-auto uk-width-1-5@m uk-text-left">
                <div class="omrs-input-group uk-margin-bottom">
                    <label class="omrs-input-underlined input-outlined">
                        <input type="password" required />
                        <span class="omrs-input-label">Nombre</span>
                    </label>
                </div>
                <div class="omrs-input-group uk-margin">
                    <label class="omrs-input-underlined input-outlined">
                        <input type="password" required />
                        <span class="omrs-input-label">Correo</span>
                    </label>
                </div>
                <div class="select">
                    <select class="select-text" required>
                        <option value="" disabled selected></option>
                        <option value="1">NDP</option>
                        <option value="2">NDP</option>
                        <option value="3">NDP</option>
                    </select>
                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label class="select-label">Partido</label>
                </div>
            </div>
            <div class="uk-width-auto uk-width-1-5@m uk-text-left">
                <div class="select">
                    <select class="select-text" required>
                        <option value="" disabled selected></option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label class="select-label">Estatus</label>
                </div>
                <small>Los usuarios inactivos no podrán tener acceso al sistema.</small>
            </div>
        </div>

        <h4 class="uk-text-bold">Secciones</h4>

        <!-- Tabla -->
        <div class="uk-overflow-auto uk-width-1-2@m">
            <table class="uk-table uk-table-small uk-table-divider uk-table-justify">
                <thead class="uk-background-muted">
                    <tr>
                        <th>Número de Sección</th>
                        <th>Distrito federal</th>
                        <th>Distrito local</th>
                        <th>Municipio</th>
                        <th>
                            <a class="uk-text-primary" href="" uk-icon="icon: plus-circle; ratio: 1"></a>
                            <a class="uk-text-danger" href="" uk-icon="icon: minus-circle; ratio: 1"></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="myFunction(this)">
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">#3530</option>
                                    <option value="2">#4540</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Michoacán</option>
                                    <option value="2">Michoacán</option>
                                </select>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">#3530</option>
                                    <option value="2">#4540</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Michoacán</option>
                                    <option value="2">Michoacán</option>
                                </select>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">#3530</option>
                                    <option value="2">#4540</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="select">
                                <select class="select-text select-borderless" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Michoacán</option>
                                    <option value="2">Michoacán</option>
                                </select>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

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
@endsection