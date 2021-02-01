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
            @if($agente == true || $brigadista)
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
                        <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{asset('storage/avatar/'.Auth::user()->avatar)}}" width="200" height="200"
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
                <br />
                    @if($agente == true || $brigadista)
                        <div class="uk-text-bold">Zona, secciones</div>
                        <div>Nombre de la zona, 14 secciones</div>
                    @endif                    
            </div>
        </div>
    </div>
    <!-- Card de PARTIDO ELECTORAL -->
    @if($agente == true || $brigadista)
        <div class="uk-card uk-card-default uk-card-body uk-margin-top">
            <div class="uk-card-title">
                <h3 class="uk-text-bold">Partido electoral</h3>
                <a class="uk-position-right uk-padding" href="{{route('ajustes_partido_elect')}}" uk-icon="cog"></a>
            </div>

            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                <div class="uk-width-auto uk-width-1-6@m">
                    <!-- Avatar circulo -->
                    <div>
                        <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200" height="200"
                            alt="Border circle" />
                    </div>
                    Nombre del partido NDP
                </div>
                <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                    <div class="uk-text-bold">Postulación</div>
                    <div>Gobernador estatal de Michoacán</div>
                    <br />
                    <div class="uk-text-bold">Candidato(a)</div>
                    <div>José Solórzano Huerta</div>
                    <br />
                    <div class="uk-text-bold">Municipio, estado</div>
                    <div>Morelia, Michoacán</div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection