@extends('layouts.layout')

@section('title')
Ajustes
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">Cuenta</h3>
            @if($agente == true || $brigadista == true)
                <a class="uk-position-right uk-padding" href="{{route('ajustes_cuenta')}}" uk-icon="cog"></a>
            @else
            <a class="uk-position-right uk-padding" href="{{route('admin-cuenta')}}" uk-icon="cog"></a>
            @endif
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-6@m">
                <!-- Avatar circulo -->
                <div class="avatar-wrapper"> 
                    @if(Auth::user()->avatar !=NULL)
                        <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{asset('storage/uploads/'.Auth::user()->avatar)}}" width="200" height="200"
                            alt="Foto" />
                    @else
                        <img class="uk-border-circle" src="{{asset('img/test/default.png')}}" width="200" height="200"
                                alt="Foto" />
                    @endif
                </div>
            </div>
            <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                <div class="uk-text-bold">Nombre</div>
                <div>{{ Auth::user()->name }}</div> 
                <br />
                <div class="uk-text-bold">Correo electrónico</div>
                <div>{{ Auth::user()->email }}</div>
                {{-- <br />
                    @if($agente == true || $brigadista)
                        <div class="uk-text-bold">Zona, secciones</div>
                        <div>Nombre de la zona, 14 secciones</div>
                    @endif                     --}}
            </div>
        </div>
    </div>
    <!-- Card de PARTIDO ELECTORAL -->
    @if($agente == true || $brigadista == true)
        @if (!is_null($campana))
        <!-- Card de PARTIDO ELECTORAL -->
        <div class="uk-card uk-card-default uk-card-body uk-margin-top">
            <div class="uk-card-title">
                <h3 class="uk-text-bold">
                    Campaña
                </h3>
                {{-- <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a> --}}
            </div>

            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                <div class="uk-width-auto uk-width-1-5@m">

                    <!-- Avatar circulo -->
                    <div class="uk-grid uk-child-width-1">
                        @foreach ($campana->politic_partie as $pp)
                        <div class="uk-flex uk-flex-middle uk-margin-bottom">
                            <img class="uk-border-circle" src="{{asset('img/logoPartidos/'.$pp->logo)}}" width="80" height="80" alt="Border circle" />
                            <div class="uk-margin-left">
                                {{$pp->siglas}}
                            </div> 
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="uk-width-auto uk-width-expand@m uk-text-left">
                    <div class="uk-text-bold">Nombre de la campaña</div>
                    <div>{{$campana->name}}</div>
                    <br />
                    <div class="uk-text-bold">Postulación</div>
                    <div>{{$campana->position->name}}</div>
                    <br />
                    <div class="uk-text-bold">Candidato(a)</div>
                    <div>{{$campana->candidato}}</div>
                    <br />
                    <div class="uk-text-bold">Municipio, estado</div>
                    <div>
                        @php
                        $towns = [];
                        foreach ($campana->section as $section) {
                        if (!in_array($section->town->id, $towns)) {
                        echo ($section->town->nombre.', ');
                        echo ($section->town->federal_entitie->nombre);
                        echo "<br>";
                        array_push($towns, $section->town->id);
                        }
                        }
    
                        @endphp
                    </div>
                    <br />
                    <div class="uk-text-bold uk-text-primary">Código de campaña</div>
                    <div>{{$campana->codigo}}</div>
                    @if($agente == true)
                        <div class="uk-text-muted">
                            Este código deberá ser proporcionado a los brigadistas para que
                            puedan registrarse en iElecet
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <!-- Card de PARTIDO ELECTORAL -->
        <div class="uk-card uk-card-default uk-card-body uk-margin-top">
            <div class="uk-card-title">
                <h3 class="uk-text-bold">
                    Sin campaña
                </h3>
                <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a>
            </div>
        </div>
        @endif
    @endif
</div>
@endsection