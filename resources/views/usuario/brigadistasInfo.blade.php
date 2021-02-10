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
                <form action="/brigadistas" method="get">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="search" placeholder="Buscar" />
                            <button type="submit" class="input-trail-icon" uk-icon="search"></button>
                        </label>
                    </div>
                </form>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                <form action="/brigadistas" method="get">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="search" placeholder="Buscar" />
                            <button type="submit" class="input-trail-icon" uk-icon="search"></button>
                        </label>
                    </div>
                </form>
            </div>
            @if($agente == true)
                <a class="uk-padding-small" href="{{route('brigadistas_sol')}}">Solicitudes</a>
            @endif
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
                                    @if($agente == false)
                                        <th>Id Campaña </th>
                                    @endif
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
                                        @if($agente == false)
                                            <td><a href="/admin/campana/{{$campana->id}}"> {{$b->id_campaign}} </a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $brigadistas->links() !!}
                    </div>
                </div>
                @if($agente == true)
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
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
@endsection