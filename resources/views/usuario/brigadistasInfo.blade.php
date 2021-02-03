@extends('layouts.layout')

@section('title')
Brigadistas
@endsection

@section('imports')
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" /> 
@endsection

@section('body')
@php
    $totalBrigadistas=0;
    foreach($brigadistas as $b) {
        $totalBrigadistas++;
    }
@endphp

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER --> 
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">Brigadistas</h3> 
                <p class="uk-margin-left" style="margin-top: 0 !important">Total: {{$totalBrigadistas}} brigadista(s)</p>
            </div>

            <div class="uk-hidden@m">
                <div class="omrs-input-group">
                    <form id="form-buscador" class="uk-modal-body" action="{{ route('brigadistas') }}"
                        method="get" style="padding: 0">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="busc" type="text" maxlength="100" />
                            <span class="input-trail-icon" uk-icon="search"></span>
                        </label>
                    </form>
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

            <a class="uk-padding-small" href="{{route('brigadistas_sol')}}">Solicitudes</a>
            <div class="uk-padding-small" uk-grid>
                <div class="uk-width-expand@m">
                    <!-- Tabla -->
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-small uk-table-divider" style="margin-top: 0 !important">
                            <thead class="uk-background-muted">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Simpatizantes</th>
                                    <th>Fecha de registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brigadistas as $b) 
                                    <tr>
                                        <td>{{$b->id}}</td>
                                        <td>{{$b->bName}}</td>
                                        <td>{{$b->bEmail}}</td>
                                        <td>{{$b->elector->count()}}</td>
                                        <td>{{$b->bFecha}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $brigadistas->links() !!}
                        {{-- <ul class="uk-pagination uk-flex-center" uk-margin>
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
                        </ul> --}}
                    </div>
                </div>
                <div class="uk-width-1-4@m">
                    <div class="uk-text-center uk-padding-small"
                        style="border: 1px solid #007aff !important; border-radius: 4px">
                        <h3 class="uk-text-bold uk-text-primary uk-margin" style="margin: 0 !important; color:#007aff !important">
                            Código de campaña
                        </h3>
                        <h4 class="uk-margin" style="margin: 0 !important; color:black !important">{{$campana->codigo}}</h4>
                        <p style="margin: 0 !important; font-size:14px; color:#666666 !important">
                            Este código deberá ser proporcionado a los brigadistas para que
                            puedan registrarse en iElect
                        </p>
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