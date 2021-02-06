@extends('layouts.layout')

@section('title')
Error 404
@endsection

@section('imports')
<link rel="stylesheet" href="{{asset('css/admin/404.css')}}" />
@endsection

@section('body')

<div class="uk-flex uk-flex-middle uk-animation-fade uk-margin-medium uk-margin-left uk-margin-right uk-margin-remove-bottom" style="border:1px solid #E5E5E5; border-radius: 5px; height: 30rem;">
    <div class="uk-position-center">
        <div class="uk-padding-small uk-text-center">
            <h3 class="uk-margin-remove uk-text-muted" style="font-size: 24px;">ERROR 404</h3>
            <h1 class="uk-margin-remove uk-text-primary uk-text-bold text404" style="font-size: 160px;">404</h1>
            <p class="uk-margin-remove uhoh" style="font-size: 24px;">¡¡Uh-oh!! La página que buscas no existe...</p>
            <a href="#" class="button uk-margin-top">Regresar</a>
        </div>
    </div>
</div>
{{-- <div class="uk-flex uk-flex-center uk-margin-top">
    <p class="uk-text-small">Desarrollado por DragonWare</p>
    <img class="uk-margin-small-left" src="{{asset('img/icons/dragonGris.png')}}" style="max-height: 18px; max-width: 26px; width: 100%;" />
</div> --}}

@endsection