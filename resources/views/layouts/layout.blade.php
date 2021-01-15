<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('subviews.imports')
</head>

<body>
    <!-- Navbar -->
    <div class="uk-navbar-container uk-visible@m" uk-navbar style="background-color: white">
        <div class="uk-navbar-left uk-padding-small">
            <h1 class="uk-text-primary">iElect</h1>
            <!-- Cuenta -->
            <a class="uk-link-toggle" href="#">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto uk-margin-large-left">
                        <img class="uk-border-circle" width="40" height="40" src="images/avatar.jpg" />
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
            <a href="" uk-icon="icon: cog; ratio: 1.5"></a>
        </div>
    </div>

    <!-- Segundo Navbar -->
    <div class="uk-navbar-container uk-visible@m" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#">
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
                    <a href="#">
                        <span class="uk-margin-small-right" uk-icon="grid"></span>Secciones
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
            </ul>
        </div>
        <!-- Icono ajustes -->
        <div class="uk-navbar-right uk-margin-right">
            <div>28 October 2019</div>
        </div>
    </div>

    <!-- Navbar responsivo -->
    <nav class="uk-navbar-container uk-flex-column uk-flex-top uk-hidden@m" data-uk-navbar data-uk-toggle="media: @m; cls: uk-flex-row uk-flex-top; mode: media">
        <div class="uk-flex">
            <button type="button" data-uk-toggle="target: .navbar-collapse2; animation: uk-animation-scale-up uk-transform-origin-top-left, uk-animation-scale-up uk-transform-origin-top-left uk-animation-reverse" class="uk-navbar-toggle uk-hidden@m" data-uk-navbar-toggle-icon></button>
            <h1 class="uk-text-primary" style="margin: auto">iElect</h1>
        </div>

        <div class="navbar-collapse2" hidden>
            <div class="uk-navbar-left">
                <ul data-uk-toggle="media: @m; cls: uk-navbar-nav uk-padding-remove; mode: media" class="uk-nav uk-nav-primary uk-padding-small">
                    <a class="uk-link-toggle" href="#">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="40" height="40" src="images/avatar.jpg" />
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
                        <a href="#">
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
                        <a href="#">
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
                        <a href="#">
                            <span class="uk-margin-small-right" uk-icon="cog"></span>Ajustes
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield("body")
</body>

</html>