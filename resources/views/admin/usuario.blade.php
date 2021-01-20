@extends('layouts.layout')

@section('title')
Usuario
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-card-title uk-text-bold">
                <a class="uk-margin-right" href="{{route('admin-usuarios')}}" uk-icon="arrow-left"></a>Agente
            </h3>
            <a class="uk-position-right uk-padding" href="{{route('admin-usuario_edit')}}" uk-icon="cog"></a>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-6@m">
                <!-- Avatar circulo -->
                <div>
                    <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200" height="200"
                        alt="Border circle" />
                </div>
            </div>
            <div class="uk-width-auto uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Nombre</div>
                <div>José Solórzano Huerta</div>
                <br />
                <div class="uk-text-bold">Correo electrónico</div>
                <div>correo@ejemplo.com</div>
                <br />
                <div class="uk-text-bold">Zona, secciones</div>
                <div>Nombre de la zona, 14 secciones</div>
            </div>
            <div class="uk-width-auto uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Total de brigadistas</div>
                <div>578</div>
                <br />
                <div class="uk-text-bold">Código de campaña</div>
                <div>########</div>
            </div>
        </div>

        <h4 class="uk-text-bold">Secciones</h4>

        <!-- Tabla -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="uk-background-muted">
                    <tr>
                        <th>Número de Sección</th>
                        <th>Distrito federal</th>
                        <th>Distrito local</th>
                        <th>Municipio</th>
                        <th>Estatus</th>
                        <th># Simpatizantes</th>
                        <th>Meta final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="myFunction(this)">
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>485</td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>485</td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>485</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection