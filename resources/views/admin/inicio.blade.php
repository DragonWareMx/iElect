@extends('layouts.layout')

@section('title')
Inicio
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-grid uk-grid-match">
        <!-- Card de SECCIONES -->
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-padding-small uk-overflow-auto">
                <h3 class="uk-card-title uk-text-bold uk-margin-remove">Usuarios</h3>
                <p class="uk-margin-remove-top">Total: {{$totalUsers}}</p>
                <div>
                    <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom" style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-user">
                        Agregar usuario
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
                <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                    <button class="uk-button uk-button-default uk-background-muted uk-margin-right" style="
                        justify-content: center;
                        align-items: center;
                        display: flex;
                        max-height: 55px !important;
                        " uk-toggle="target: #modal-agregar-user">
                        Agregar usuario
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
                <div uk-grid>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/admin.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Administradores</p>
                        <p class="uk-margin-remove">{{$totalAdmins}}</p>
                    </div>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/agente.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Agentes</p>
                        <p class="uk-margin-remove">{{$totalAgents}}</p>
                    </div>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/brigadista.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Brigadistas</p>
                        <p class="uk-margin-remove">{{$totalBrigadists}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card de SIMPATIZANTES -->
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-padding-small">
                <h3 class="uk-card-title uk-text-bold" style="margin: 0">
                    Simpatizantes
                </h3>
                <div>Total: 6</div>
                <div class="uk-flex uk-flex-middle">
                    <div>
                        <canvas id="simpChart" width="auto" height="200"></canvas>
                    </div>
                    <div class="uk-flex-none">
                        <div>
                            <span class="uk-badge" style="background-color: #FFD43A"></span>
                            NDP
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #04BE65"></span>
                            PAN
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #2D9B94"></span>
                            PRI
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #3201C8"></span>
                            PRD
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #C8194B"></span>
                            PT
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #ADADAD"></span>
                            PES
                        </div>
                    </div>
                </div>
                <p>
                    Partidos políticos presentes en iElect
                </p>
            </div>
        </div>
    </div>
    <!-- Card de CAMPAÑAS -->
    <div class="uk-width-expand@m uk-margin-top">
        <div class="uk-card uk-card-default uk-padding-small uk-overflow-auto">
            <h3 class="uk-card-title uk-text-bold uk-margin-remove">Campañas</h3>
            <p class="uk-margin-remove-top">Total: {{$totalCampanas}}</p>
            <div>
                <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom" style="
              justify-content: center;
              align-items: center;
              display: flex;
              max-height: 55px !important;
            " uk-toggle="target: #modal-agregar-campana">
                    Agregar campaña
                    <span uk-icon="icon: plus" class="uk-margin-left"></span>
                </button>
            </div>
            <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                <button class="uk-button uk-button-default uk-background-muted uk-margin-right" style="
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    max-height: 55px !important;
                    " uk-toggle="target: #modal-agregar-campana">
                    Agregar campaña
                    <span uk-icon="icon: plus" class="uk-margin-left"></span>
                </button>
            </div>
            <div uk-grid>
                <div class="uk-width-1-4@m uk-text-center">
                    <img src="{{asset('img/icons/admin.png')}}" style="max-width: 120px; width: 100%;" />
                    <p class="uk-text-bold uk-margin-remove">Nombre de la campaña</p>
                    <p class="uk-margin-remove">#Código</p>
                    <p class="uk-margin-remove">Candidato</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Card de PARTIDO ELECTORAL -->
    <div class="uk-card uk-card-default uk-padding-small uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">Zonas cubiertas</h3>
            <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Entidades federativas</div>
                <div>5 entidades cubiertas</div>
                <br />
                <div class="uk-text-bold">Distritos federales</div>
                <div>24 distritos cubiertos</div>
                <br />
                <div class="uk-text-bold">Distritos locales</div>
                <div>53 distritos cubierto</div>
                <br />
                <div class="uk-text-bold">Municipios</div>
                <div>89 municipios cubiertos</div>
            </div>
            <div class="uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Secciones</div>
                <div>2578 secciones cubiertas</div>
            </div>
            <div class="uk-width-1-3@m">
                <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                <canvas id="barChart" width="auto" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Usuario -->
    <div id="modal-agregar-user" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Agregar usuario</h2>
            </div>
            <div id="errors" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <form id="form-nuevo-usuario" class="uk-modal-body" action="/admin/agregar/usuario" method="POST" enctype="multipart/form-data">
                @csrf
                <div uk-grid>
                    <div class="uk-width-1">
                        <!-- Avatar -->
                        <div class="avatar-wrapper uk-margin-bottom">
                            <img id="avatar" class="profile-pic uk-border-circle uk-flex" style="margin-left:auto; margin-right:auto; background-size:cover; object-fit:cover; height:200px;" src="{{asset('/img/icons/default.png')}}" width="200"
                                height="200" alt="Border circle" />
                            <div id="foto" class=" uk-text-center" style="cursor: pointer">
                                Agregar foto
                                <span class="uk-margin-small-left" uk-icon="upload"></span>
                            </div>
                            <input name="fileField" type="file" id="fileField" style="visibility:hidden;height:2px;width:30px"/>
                        </div>
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">NOMBRE</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required name="name" type="text" maxlength="255" />
                                        <span class="omrs-input-label">Nombre completo</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CORREO</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required type="email" autocomplete="nope" name="email" maxlength="255"/>
                                        <span class="omrs-input-label">Correo electrónico</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required type='password' autocomplete='new-password' id="password" name="password" onchange="validatePassword();" maxlength="255"/>
                                        <span class="omrs-input-label">Contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CONFIRMAR CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required type='password' autocomplete='new-password' id="password-confirm" onkeyup="validatePassword()" name="password-confirm" maxlength="255"/>
                                        <span class="omrs-input-label">Confirmar contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">TIPO</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" required name="type">
                                        <option value="agente">Agente</option> 
                                        <option value="admin">Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button id="btnEnviar" class="uk-button uk-button-primary" type="submit">
                        Enviar
                    </button>
                </p>
            </form>
        </div>
    </div>

    <!-- Modal Agregar Campaña -->
    <div id="modal-agregar-campana" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Agregar campana</h2>
            </div>
            <div id="errors-campana" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <form id="form-nueva-campana" class="uk-modal-body" action="{{ route('agregar-campana')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div uk-grid>
                    <div class="uk-width-1">
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">NOMBRE DE CAMPAÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required name="name_camp" type="text" maxlength="100" />
                                        <span class="omrs-input-label">Nombre de la campaña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">NOMBRE DEL CANDIDATO</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required type="text" name="name_cand" maxlength="255"/>
                                        <span class="omrs-input-label">Nombre del candidato</span>
                                    </label>
                                </div>
                            </div>
                            {{-- INPUT DE PARTIDOS --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">PARTIDOS</h6>
                                <div id="agregar_partido" class="uk-flex uk-flex-middle uk-flex-right" style="cursor:pointer; margin-top:-15px;">
                                    <img src="{{asset('/img/icons/add.png')}}" width="10px" style="margin-right:5px;di"/>
                                    <div class="uk-text-primary" style="font-size: 12px;line-height: 15px;"> Agregar</div>
                                </div>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="partido" list="partidos"type="text" name="parties" maxlength="10"/>
                                        <datalist id="partidos">
                                            @foreach ($parties as $partie)
                                                <option value="{{$partie->siglas}}"></option>
                                            @endforeach
                                        </datalist>
                                    </label>
                                </div>
                                <div id="lista_partidos" class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    <input type="hidden" id="input_partidos" name="input_partidos" value="" />
                                </div>
                            </div>
                            {{-- INPUT DE AGENTES --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">AGENTES</h6>
                                <div id="agregar_agente" class="uk-flex uk-flex-middle uk-flex-right" style="cursor:pointer; margin-top:-15px;">
                                    <img src="{{asset('/img/icons/add.png')}}" width="10px" style="margin-right:5px;di"/>
                                    <div class="uk-text-primary" style="font-size: 12px;line-height: 15px;"> Agregar</div>
                                </div>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="agente" list="agentes"type="text" name="agentes" maxlength="255"/>
                                        <datalist id="agentes">
                                            @foreach ($agents as $agent)
                                                <option value="{{$agent->name}}"></option>
                                            @endforeach
                                        </datalist>
                                    </label>
                                </div>
                                <div id="lista_agentes" class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    <input type="hidden" id="input_agentes" name="input_agentes" value="" />
                                </div>
                            </div>
                            {{-- SELECT DE SECCIONES --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">SECCIONES</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="secciones">
                                        <option value="" disabled selected>Seleccionar secciones por:</option> 
                                        <option value="1">Distrito local</option> 
                                        <option value="2">Distrito federal</option> 
                                        <option value="3">Municipio</option> 
                                    </select>
                                </div>
                            </div>
                            <div id="locales"class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR DISTRITO LOCAL</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="local">
                                        <option value="">Selecciona un distrito local</option>
                                        @foreach($locales as $local)
                                            <option value="{{$local->id}}">{{$local->cabecera}}</option>
                                        @endforeach
                                    </select>
                                    <div id="lista_locales" class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    </div>
                                    <input type="hidden" id="input_locales" name="input_locales" value="" />
                                </div>
                            </div>
                            <div id="federales" class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR DISTRITO FEDERAL</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="federal">
                                        <option value="">Selecciona un distrito federal</option>
                                        @foreach($federales as $federal)
                                            <option value="{{$federal->id}}">{{$federal->cabecera}}</option>
                                        @endforeach
                                    </select>
                                    <div id="lista_federales" class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    </div>
                                    <input type="hidden" id="input_federales" name="input_federales" value="" />
                                </div>
                            </div>
                            <div id="municipios" class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR MUNICIPIO</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="municipio">
                                        <option value="">Selecciona un municipio</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <div id="lista_municipios" class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    </div>
                                    <input type="hidden" id="input_municipios" name="input_municipios" value="" />
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">POSICIÓN</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" required name="position">
                                        @foreach ($positions as $position)
                                            <option value="{{$position->id}}">{{$position->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button id="btnEnviar-campana" class="uk-button uk-button-primary" type="submit">
                        Enviar
                    </button>
                </p>
            </form>
        </div>
    </div>
</div>


<script>

    var arrPartidos=[];
    var arrAgentes=[];
    var arrLocales=[];
    var arrFederales=[];
    var arrMunicipios=[];


    //Script para manejar las secciones
    $('#secciones').on('change', function() {
        arrLocales=[];
        arrFederales=[];
        arrMunicipios=[];
        $('#input_federales').val(arrFederales);
        $('#input_locales').val(arrLocales);
        $('#input_municipios').val(arrMunicipios);
        $('#federales').css('display','none');
        $('#locales').css('display','none');
        $('#municipios').css('display','none');
        $('#lista_locales').empty();
        $('#lista_federales').empty();
        $('#lista_municipios').empty();
        switch(this.value) {
        case '1':
            $('#locales').css('display','block').hide().show('normal');
            break;
        case '2':
            $('#federales').css('display','block').hide().show('normal');
            break;
        case '3':
            $('#municipios').css('display','block').hide().show('normal');
            break;
        }
    });
    // ONCHANGES DEL SELECT DE LOCALES
    $('#local').on('change', function(){
        var input = $('#local').children("option:selected").val();
        var locales = JSON.parse('<?php echo empty($locales) ? '{}' : json_encode($locales) ?>');
        for(var key in locales){
            var obj=locales[key];
            if(obj["id"] == input){
                $("#local").val('');
                if($.inArray(obj["id"],arrLocales)==-1){
                    $('#lista_locales').append('<div id="'+obj['id']+'l" class="uk-flex uk-flex-middle"><img class="delete_local" uk-tooltip="title: Eliminar; pos: left" data-id="'+obj["id"]+'" src="/img/icons/less.png" width="10px" style="cursor:pointer"><div class="uk-margin-small-left uk-text-small uk-text-truncate">'+obj["cabecera"]+'</div></div>');
                    $('#'+obj["id"]+'l').hide().show('normal');
                    arrLocales.push(obj["id"]);
                    $('#input_locales').val(arrLocales);
                }
                break;
            }
        }
    });
    $(document.body).on('click','.delete_local', function(e) {
        var id=$(this).data('id');
        arrLocales = jQuery.grep(arrLocales, function(value) {
            return value != id;
        });
        $('#'+id+'l').hide('normal');
        setTimeout(
            function()
            {
                var div = document.getElementById(id+'l');
                div.remove();
            },
        500);
        $('#input_locales').val(arrLocales);
    });
    // ONCHANGES DEL SELECT DE FEDERALES
    $('#federal').on('change', function(){
        var input = $('#federal').children("option:selected").val();
        var federales = JSON.parse('<?php echo empty($federales) ? '{}' : json_encode($federales) ?>');
        for(var key in federales){
            var obj=federales[key];
            if(obj["id"] == input){
                $("#federal").val('');
                if($.inArray(obj["id"],arrFederales)==-1){
                    $('#lista_federales').append('<div id="'+obj['id']+'f" class="uk-flex uk-flex-middle"><img class="delete_federal" uk-tooltip="title: Eliminar; pos: left" data-id="'+obj["id"]+'" src="/img/icons/less.png" width="10px" style="cursor:pointer"><div class="uk-margin-small-left uk-text-small uk-text-truncate">'+obj["cabecera"]+'</div></div>');
                    $('#'+obj["id"]+'f').hide().show('normal');
                    arrFederales.push(obj["id"]);
                    $('#input_federales').val(arrFederales);
                }
                break;
            }
        }
    });
    $(document.body).on('click','.delete_federal', function(e) {
        var id=$(this).data('id');
        arrFederales = jQuery.grep(arrFederales, function(value) {
            return value != id;
        });
        $('#'+id+'f').hide('normal');
        setTimeout(
            function()
            {
                var div = document.getElementById(id+'f');
                div.remove();
            },
        500);
        $('#input_federales').val(arrFederales);
    });
    // ONCHANGES DEL SELECT DE MUNICIPIOS
    $('#municipio').on('change', function(){
        var input = $('#municipio').children("option:selected").val();
        var municipios = JSON.parse('<?php echo empty($municipios) ? '{}' : json_encode($municipios) ?>');
        for(var key in municipios){
            var obj=municipios[key];
            if(obj["id"] == input){
                $("#municipio").val('');
                if($.inArray(obj["id"],arrMunicipios)==-1){
                    $('#lista_municipios').append('<div id="'+obj['id']+'m" class="uk-flex uk-flex-middle"><img class="delete_municipio" uk-tooltip="title: Eliminar; pos: left" data-id="'+obj["id"]+'" src="/img/icons/less.png" width="10px" style="cursor:pointer"><div class="uk-margin-small-left uk-text-small uk-text-truncate">'+obj["nombre"]+'</div></div>');
                    $('#'+obj["id"]+'m').hide().show('normal');
                    arrMunicipios.push(obj["id"]);
                    $('#input_municipios').val(arrMunicipios);
                }
                break;
            }
        }
    });
    $(document.body).on('click','.delete_municipio', function(e) {
        var id=$(this).data('id');
        arrMunicipios = jQuery.grep(arrMunicipios, function(value) {
            return value != id;
        });
        $('#'+id+'m').hide('normal');
        setTimeout(
            function()
            {
                var div = document.getElementById(id+'m');
                div.remove();
            },
        500);
        $('#input_municipios').val(arrMunicipios);
    });

    //AGREGAR PARTIDOS
    $('#agregar_partido').click(function(){
        var input=$('#partido');
        var partidos = JSON.parse('<?php echo empty($parties) ? '{}' : json_encode($parties) ?>');
        for(var key in partidos){
            var obj=partidos[key];
            if(obj["siglas"] == input.val()){
                input.val("").change();
                if($.inArray(obj["id"],arrPartidos)==-1){
                    $('#lista_partidos').append('<div id="'+obj['id']+'p" class="uk-flex uk-flex-middle"><img class="delete_partido" uk-tooltip="title: Eliminar; pos: left" data-id="'+obj["id"]+'" src="/img/icons/less.png" width="10px" style="cursor:pointer"><div class="uk-margin-small-left uk-text-small uk-text-truncate">'+obj["siglas"]+'</div></div>');
                    $('#'+obj["id"]+'p').hide().show('normal');
                    arrPartidos.push(obj["id"]);
                    $('#input_partidos').val(arrPartidos);
                }
                break;
            }
        }
    });
    $(document.body).on('click','.delete_partido', function(e) {
        var id=$(this).data('id');
        arrPartidos = jQuery.grep(arrPartidos, function(value) {
            return value != id;
        });
        $('#'+id+'p').hide('normal');
        setTimeout(
            function()
            {
                var div = document.getElementById(id+'p');
                div.remove();
            },
        500);
        $('#input_partidos').val(arrPartidos);
    });

    $('#agregar_agente').click(function(){
        var input=$('#agente');
        var agentes = JSON.parse('<?php echo empty($agents) ? '{}' : json_encode($agents) ?>');
        for(var key in agentes){
            var obj=agentes[key];
            if(obj["name"] == input.val()){
                input.val("").change();
                if($.inArray(obj["id"],arrAgentes)==-1){
                    $('#lista_agentes').append('<div id="'+obj['id']+'a" class="uk-flex uk-flex-middle"><img class="delete_agente" uk-tooltip="title: Eliminar; pos: left" data-id="'+obj["id"]+'" src="/img/icons/less.png" width="10px" style="cursor:pointer"><div class="uk-margin-small-left uk-text-small uk-text-truncate">'+obj["name"]+'</div></div>');
                    $('#'+obj["id"]+'a').hide().show('normal');
                    arrAgentes.push(obj["id"]);
                    $('#input_agentes').val(arrAgentes);
                }
                break;
            }
        }
    });
    $(document.body).on('click','.delete_agente', function(e) {
        var id=$(this).data('id');
        arrAgentes = jQuery.grep(arrAgentes, function(value) {
            return value != id;
        });
        $('#'+id+'a').hide('normal');
        setTimeout(
            function()
            {
                var div = document.getElementById(id+'a');
                div.remove();
            },
        500);
        $('#input_agentes').val(arrAgentes);
    });

    var password = document.getElementById("password")
    , confirm_password = document.getElementById("password-confirm");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Las contraseñas no coinciden");
            confirm_password.reportValidity();
        } else {
            confirm_password.setCustomValidity('');
            confirm_password.reportValidity();
        }
    }
    jQuery(($) => {
        //esto es para la foto de perfil
        $('#foto').on('click', function() {
            $("#fileField").click();
        });

        function readURL(input) {
            $('#avatar').attr('src', "/img/icons/default.png");
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#fileField").change(function() {
            readURL(this);
        });
    });

    //ajax del form de nuevo usuario
    $("#form-nuevo-usuario").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar");

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: function(data){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button
                btnEnviar.val("Enviando"); // Para input de tipo button
                btnEnviar.attr("disabled","disabled");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                btnEnviar.val("Enviar formulario");
            },
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                UIkit.notification({
                    message: '<span uk-icon=\'icon: check\'></span> Usuario creado con éxito!',
                    status: 'success',
                    pos: 'top-center',
                    timeout: 2000
                });
                $('#errors').css('display', 'none');
                setTimeout(
                function()
                {
                    window.location.reload(true);
                }, 2000);
            },
            error: function(data){
                console.log(data);
                // $('#success').css('display', 'none');
                btnEnviar.removeAttr("disabled");
                $('#errors').css('display', 'block');
                var errors = data.responseJSON.errors;
                var errorsContainer = $('#errors');
                errorsContainer.innerHTML = '';
                var errorsList = '';
                // for (var i = 0; i < errors.length; i++) {
                // //     //if(errors[i].redirect)
                // //         //window.location.href = window.location.origin + '/logout'
                    
                //     errorsList += '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'+ errors[i].errors +'</p></div>';
                // }
                for(var key in errors){
                    var obj=errors[key];
                    console.log(obj);
                    for(var yek in obj){
                        var error=obj[yek];
                        console.log(error);
                        errorsList += '<div><a></a><p>'+ error +'</p></div>';
                    }
                }
                errorsContainer.html(errorsList);
                UIkit.notification({
                    message: '<span uk-icon=\'icon: close\'></span>Problemas al tratar de enviar el formulario, inténtelo más tarde.',
                    status: 'danger',
                    pos: 'top-center',
                    timeout: 2000
                });
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });

    //ajax del form de nueva campaña
    $("#form-nueva-campana").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar-campana");

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend: function(data){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button
                btnEnviar.val("Enviando"); // Para input de tipo button
                btnEnviar.attr("disabled","disabled");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                btnEnviar.val("Enviar formulario");
            },
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                UIkit.notification({
                    message: '<span uk-icon=\'icon: check\'></span> Campaña creada con éxito!',
                    status: 'success',
                    pos: 'top-center',
                    timeout: 2000
                });
                $('#errors-campana').css('display', 'none');
                setTimeout(
                function()
                {
                    window.location.reload(true);
                }, 2000);
            },
            error: function(data){
                console.log(data);
                // $('#success').css('display', 'none');
                btnEnviar.removeAttr("disabled");
                $('#errors-campana').css('display', 'block');
                var errors = data.responseJSON.errors;
                var errorsContainer = $('#errors-campana');
                errorsContainer.innerHTML = '';
                var errorsList = '';
                // for (var i = 0; i < errors.length; i++) {
                // //     //if(errors[i].redirect)
                // //         //window.location.href = window.location.origin + '/logout'
                    
                //     errorsList += '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'+ errors[i].errors +'</p></div>';
                // }
                for(var key in errors){
                    var obj=errors[key];
                    console.log(obj);
                    for(var yek in obj){
                        var error=obj[yek];
                        console.log(error);
                        errorsList += '<div><a></a><p>'+ error +'</p></div>';
                    }
                }
                errorsContainer.html(errorsList);
                UIkit.notification({
                    message: '<span uk-icon=\'icon: close\'></span>Problemas al tratar de enviar el formulario, inténtelo más tarde.',
                    status: 'danger',
                    pos: 'top-center',
                    timeout: 2000
                });
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });


    //info para la gráfica de pastel
    var simpCanvas = document.getElementById("simpChart");
    var simpData = {
    datasets: [{
        data: [13, 10, 1, 2, 10, 8],
        backgroundColor: ["#C8194B", "#FFD43A", "#ADADAD", "#3201C8", "#2D9B94", "#04BE65"],
    },],
    };

    var pieChart = new Chart(simpCanvas, {
        type: "pie",
        data: simpData,
    });
</script>

@endsection

@section('scripts')

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

//Grafica de barras
var ctx = document.getElementById("barChart").getContext("2d");
var barChart = new Chart(ctx, {
type: "bar",
data: {
labels: ["DF", "MICH", "SLP", "OAX", "DRG", "SNL"],
datasets: [
{
data: [200, 153, 60, 180, 130, 175],
backgroundColor: ["#9B51E0", "#FB8832", "#FFCB01", "#C8194B", "#2D9B94", "#3201C8"],
},
],
},
options: {
maintainAspectRatio: false,
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
},
});

@endsection