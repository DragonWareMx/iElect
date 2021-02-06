@extends('layouts.layout')

@section('title')
Solicitudes brigadistas
@endsection

@section('imports')
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" /> 
@endsection

@section('body')
@php
    $totalSoli=0;
    foreach($solicitudes as $soli){
        $totalSoli++;
    }
@endphp
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
                <p class="uk-margin-left" style="margin-top: 0 !important">Total: {{$totalSoli}} solicitude(s)</p>
            </div>
            <div class="uk-hidden@m uk-padding-small">
                <form action="/brigadistas/solicitudes" method="get">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="search" placeholder="Buscar" />
                            <button type="submit" class="input-trail-icon" uk-icon="search"></button>
                        </label>
                    </div>
                </form>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                <form action="/brigadistas/solicitudes" method="get">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="search" placeholder="Buscar" />
                            <button type="submit" class="input-trail-icon" uk-icon="search"></button>
                        </label>
                    </div>
                </form>
            </div>

            @if (session()->get('status'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul>
                    <li>{{session()->get('status')}}</li>
                </ul>
            </div>
            @endif
            @if ($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="uk-alert-danger uk-flex uk-flex-middle" id="alert0" style="display:none" uk-alert>
                <a class="uk-alert-close" uk-close ></a>
                <p>Selecciona al menos un brigadista.</p>
            </div>

            <form action="{{route('brigadistas_accion')}}" method="POST" id="form">
                @csrf
                <div class="uk-padding-small" uk-grid> 
                    <div class="uk-width-2-3@m">
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <a onclick="toggle(this)">Seleccionar todo</a>
                            </div>
                            <div class="uk-width-1-2@m">
                                <div class="uk-flex-inline uk-align-right@m uk-flex-middle">
                                    <a onclick="comprobar()" class="uk-button uk-button-text uk-margin-right uk-text-bold uk-text-danger">
                                        Eliminar 
                                    </a>
                                    <button class="uk-button uk-button-primary" onclick="comprobar()">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabla Solicitudes brigadistas -->
                <div class="uk-padding-small" uk-grid style="margin-top: 0 !important">
                    <div class="uk-width-2-3@m">
                        <!-- Tabla -->
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo electrónico</th>
                                        <th>Fecha de solicitud</th>
                                        <th>Campaña</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($solicitudes as $soli)
                                        <tr class="tr-s" id="{{$soli->id}}">
                                            <td>{{$soli->id}}</td>
                                            <td>{{$soli->name}}</td>
                                            <td>{{$soli->email}}</td>
                                            <td>{{$soli->created_at}}</td>
                                            <td>{{$soli->campaign_id}}</td>
                                            <td><input class="rowBotCheck" type="checkbox" id="b{{$soli->id}}" name="b[]" value="{{$soli->id}}"></td>
                                        </tr> 
                                    @endforeach                               
                                </tbody>
                            </table>
                            {!! $solicitudes->links() !!}
                        </div>
                    </div>
                </div>

                {{-- MODAL DE CONFIRMACIÓN --}}
                <div id="modal-eliminar" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body">
                        <h2 class="uk-modal-title uk-text-danger">¿Eliminar solicitud(es)?</h2>
                        <p>Selecciona "Eliminar" para completar esta acción.</p>
                        <p class="uk-text-right">
                            {{-- <form action="" method="post" class="uk-flex uk-flex-right">
                                @csrf --}}
                                <button class="uk-button uk-button-default uk-modal-close uk-margin-small-right" type="button">Cancelar</button>
                                <button class="uk-button uk-button-danger" onclick="action('eliminar')">Eliminar</button>
                            {{-- </form> --}}
                        </p>
                    </div>
                </div>

                <input type="hidden" name="action" id="action">



            </form>
        </div>
    </div>
</div>


    <script>
        var seleccionados=true;
        // Esta función es para seleccionar a los brigastas
        function toggle(source) {
            checkboxes = document.getElementsByName('b[]');
            for(var i=0 ;i< checkboxes.length;i++) {
                if(seleccionados){
                    checkboxes[i].checked = true;
                }
                else{
                    checkboxes[i].checked = false;
                }
            }
            if(seleccionados)
                seleccionados=false;
            else
                seleccionados=true
        }

        function action(accion) {
            viledruid=document.getElementById('action');
            viledruid.value=accion;
            // alert(accion);
            form=document.getElementById('form');
            form.submit();
        }

        alerta = document.getElementById('alert0');

        // Comprobar que se tenga seleccionado al menos uno
        function comprobar(){
            
            var atLeastOne=false;
            checkboxes = document.getElementsByName('b[]');
            for(var i=0 ;i< checkboxes.length;i++) {
                if(checkboxes[i].checked == true){
                    atLeastOne=true;
                    break;
                }
            }
            // Mostrar alerta de que no se ha seleccionado ninguno
            if(atLeastOne==false){
                alerta.style.display='block';
            }

            else{
                UIkit.modal('#modal-eliminar').show();
            }
        }
        
        // Cerrar alerta de que no se ha seleccionado ninguno
        function cerrarAlerta(){
            alerta.style.display='hidden';
        }
    </script>

@endsection

@section('scripts')

@endsection