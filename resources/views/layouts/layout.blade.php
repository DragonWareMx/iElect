<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('subviews.imports')

    @yield("imports")
</head>

<body>
    <!-- Navbar -->
    <div class="uk-navbar-container uk-visible@m" uk-navbar style="background-color: white">
        <div class="uk-navbar-left uk-padding-small">
            <a href="{{ route('home') }}" style="text-decoration: none">
                <h1 class="uk-text-primary">iElect</h1>
            </a>
            <!-- Cuenta -->
            <a class="uk-link-toggle" href="#">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto uk-margin-large-left">
                        <img class="uk-border-circle" width="40" height="40" src="{{asset('img/test/avatar.jpg')}}" />
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">
                            José Solórzano
                        </h3>
                        <p class="uk-text-meta uk-margin-remove-top">
                            Nombre del partido NDP
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Icono ajustes -->
        <div class="uk-navbar-right uk-padding-small">
            <div class="uk-inline">
                <button class="" type="button" uk-icon="icon: cog; ratio: 1.5" style="outline: none"></button>
                <div uk-dropdown="mode: click;pos: bottom-justify" id="dropdown">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-dropdown-close"><a href="#modal-logout" uk-toggle><span uk-icon="sign-out"
                                    style="margin-right:10px" id="logout"></span>Cerrar
                                Sesión</a></li>
                        <li class="uk-dropdown-close"><a href="{{ route('ajustes') }}"><span uk-icon="settings"
                                    style="margin-right:10px"></span>Configuración</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo Navbar -->
    <div class="uk-navbar-container uk-visible@m" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="{{route('home')}}">
                        <span class="uk-margin-small-right" uk-icon="home"></span>Inicio
                    </a>
                </li>
                <li>
                    <a href="{{route('mapa_seccional')}}">
                        <span class="uk-margin-small-right" uk-icon="album"></span>Mapa
                        Seccional
                    </a>
                </li>
                <li>
                    <a href="{{route('secciones')}}">
                        <span class="uk-margin-small-right" uk-icon="grid"></span>Secciones
                    </a>
                </li>
                <li>
                    <a href="{{route('simpatizantes')}}">
                        <span class="uk-margin-small-right" uk-icon="users"></span>Simpatizantes
                    </a>
                </li>
                <li>
                    <a href="{{route('historico')}}">
                        <span class="uk-margin-small-right" uk-icon="history"></span>Histórico
                    </a>
                </li>
                <li>
                    <a href="{{route('brigadistas')}}">
                        <span class="uk-margin-small-right" uk-icon="lifesaver"></span>Brigadistas
                    </a>
                </li>
            </ul>
        </div>
        <!-- Icono ajustes -->
        <div class="uk-navbar-right uk-margin-right">
            <div>28 October 2019</div>
        </div>
    </div>

    <!-- Navbar responsivo -->
    <nav class="uk-navbar-container uk-flex-column uk-flex-top uk-hidden@m" data-uk-navbar
        data-uk-toggle="media: @m; cls: uk-flex-row uk-flex-top; mode: media">
        <div class="uk-flex">
            <button type="button"
                data-uk-toggle="target: .navbar-collapse2; animation: uk-animation-scale-up uk-transform-origin-top-left, uk-animation-scale-up uk-transform-origin-top-left uk-animation-reverse"
                class="uk-navbar-toggle uk-hidden@m" data-uk-navbar-toggle-icon></button>
            <h1 class="uk-text-primary" style="margin: auto">iElect</h1>
        </div>

        <div class="navbar-collapse2" hidden>
            <div class="uk-navbar-left">
                <ul data-uk-toggle="media: @m; cls: uk-navbar-nav uk-padding-remove; mode: media"
                    class="uk-nav uk-nav-primary uk-padding-small">
                    <a class="uk-link-toggle" href="#">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="40" height="40"
                                    src="{{asset('img/test/avatar.jpg')}}" />
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                    José Solórzano
                                </h3>
                                <p class="uk-text-meta uk-margin-remove-top">
                                    Nombre del partido NDP
                                </p>
                            </div>
                        </div>
                    </a>
                    <li class="uk-active">
                        <a href="{{route('home')}}">
                            <span class="uk-margin-small-right" uk-icon="home"></span>Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="album"></span>Mapa
                            Seccional
                        </a>
                    </li>
                    <li>
                        <a href="{{route('secciones')}}">
                            <span class="uk-margin-small-right" uk-icon="location"></span>Secciones
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="users"></span>Simpatizantes
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="history"></span>Histórico
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ajustes')}}">
                            <span class="uk-margin-small-right" uk-icon="cog"></span>Ajustes
                        </a>
                    </li>
                    <li>
                        <a uk-toggle href="#modal-logout">
                            <span class=" uk-margin-small-right" uk-icon="sign-out"></span>Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="modal-logout" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title uk-text-danger">¿Seguro que quieres salir?</h2>
            <p>Selecciona "Cerrar sesión" si está listo para salir de iElect.</p>
            <p class="uk-text-right">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-danger" type="submit">Cerrar sesión</button>
                </form>
            </p>
        </div>
    </div>

    @yield("body")
</body>

<script>
    @yield("scripts")
</script>

</html>