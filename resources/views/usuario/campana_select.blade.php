@extends('layouts.layout')

@section('title')
Ajustes
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right uk-flex uk-flex-center">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top  uk-width-1-2@m">
        <div class="uk-card-title uk-margin-medium-bottom">
            <h3 class="uk-text-bold">Selecciona una campaña:</h3>
        </div>
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <form class="uk-width-expand uk-text-left uk-padding-large uk-padding-remove-top uk-padding-remove-bottom"
                method="POST" action="{{ route('campana-select-post') }}">
                @csrf
                @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{$errors->first()}}</p>
                </div>
                @endif
                <div class="uk-width-1@m">
                    <div class="select">
                        <select class="select-text" required name="campana">
                            <option value="" disabled selected></option>
                            @foreach ($campanas as $camp)
                            <option value="{{$camp->id}}">{{$camp->name}}</option>
                            @endforeach
                        </select>
                        <span class="select-highlight"></span>
                        <span class="select-bar"></span>
                        <label class="select-label">Campaña</label>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" id="btnEnviar" type="submit">
                        Continuar
                    </button>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection