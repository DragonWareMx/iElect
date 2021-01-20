@extends('layouts.layout')

@section('title')
Partido electoral
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title uk-text-bold">
            <a class="uk-margin-right" href="{{route('ajustes')}}" uk-icon="arrow-left"></a>Partido
            electoral
        </h3>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto">
                <!-- Avatar circulo -->
                <div>
                    <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200" height="200"
                        alt="Border circle" />
                </div>
                Nombre del partido NDP
            </div>
            <div class="uk-width-1-4@m uk-text-left">
                <div class="omrs-input-group uk-margin-bottom">
                    <label class="omrs-input-underlined input-outlined">
                        <input class="uk-input" required />
                        <span class="omrs-input-label">Postulación</span>
                    </label>
                </div>

                <div class="omrs-input-group uk-margin-bottom">
                    <label class="omrs-input-underlined input-outlined">
                        <input class="uk-input" required />
                        <span class="omrs-input-label">Candidato(a)</span>
                    </label>
                </div>

                <div class="omrs-input-group uk-margin-bottom">
                    <label class="omrs-input-underlined input-outlined">
                        <input class="uk-input" required />
                        <span class="omrs-input-label">Municipio, estado</span>
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