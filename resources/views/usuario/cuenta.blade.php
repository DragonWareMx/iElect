@extends('layouts.layout')

@section('title')
Cuenta
@endsection

@section('imports')
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" />
@endsection

@section('body')

<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title uk-text-bold">
            <a class="uk-margin-right" href="{{route('ajustes')}}" uk-icon="arrow-left"></a>Cuenta
        </h3>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-auto@m">
                <!-- Avatar circulo -->
                <div class="avatar-wrapper">
                    <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200"
                        height="200" alt="Border circle" />
                    <div class="upload-text">
                        Editar foto
                        <span class="uk-margin-small-left" uk-icon="upload"></span>
                    </div>
                </div>
            </div>
            <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                <div class="uk-text-primary">Cambiar contraseña</div>

                <div class="omrs-input-group uk-margin-bottom">
                    <label class="omrs-input-underlined input-outlined">
                        <input type="password" required />
                        <span class="omrs-input-label">Contraseña actual</span>
                    </label>
                </div>
                <div class="omrs-input-group uk-margin">
                    <label class="omrs-input-underlined input-outlined">
                        <input type="password" required />
                        <span class="omrs-input-label">Nueva contraseña</span>
                    </label>
                </div>
                <div class="omrs-input-group uk-margin">
                    <label class="omrs-input-underlined input-outlined">
                        <input type="password" required />
                        <span class="omrs-input-label">Confirmar contraseña</span>
                    </label>
                </div>
            </div>
        </div>

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">
                Cancelar
            </button>
            <button class="uk-button uk-button-primary" type="button">
                Guardar
            </button>
        </p>
    </div>
</div>

@endsection