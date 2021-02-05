@extends('layouts.layout')

@section('title')
Campañas
@endsection

@section('imports')

@endsection

@section('body')
<!-- Modal Datos campaña -->
<div id="modal-datos-camp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title" id="info-title">Campaña #</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <div class="uk-width-1@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-text-center uk-margin-medium-bottom">
                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="150"
                            height="150" alt="Border circle" id="info-foto" style="object-fit:cover;height:150px;" />
                    </div>
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Nombre Campaña</div>
                            <div id="info-nombre">José Agustín Aguilar Solórzano</div>
                            <br />
                            <div class="uk-text-bold">Candidato</div>
                            <div id="info-candidato">Morelia, Centro #442</div>
                            <br />
                            <div class="uk-text-bold">Puesto</div>
                            <div id="info-puesto">Escritor</div>
                            <br />
                            <div class="uk-text-bold">Código</div>
                            <div id="info-codigo">32</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Partido político</div>
                            <div>
                                <ul id="info-partido"></ul>
                            </div>
                            <br />
                            <div class="uk-text-bold">Agentes</div>
                            <div>
                                <ul id="info-agentes">
                                </ul>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            <p class="uk-text-right uk-flex uk-flex-between">
                <button class="uk-button uk-button-danger" type="submit" uk-toggle="target: #modal-delete">
                    Eliminar
                </button>
                <a id="ver-href" href="" class="uk-button uk-button-primary" type="button">
                    Ver secciones
                </a>
            </p>
        </div>
    </div>
</div>


<div id="modal-delete" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Eliminar campaña</h2>
        <div id="errors-campanaDelete" class="uk-alert-danger" uk-alert style="display:none;">
        </div>
        <p>Los datos de la campaña y los electores relacionados a ésta se eliminarán de forma permanente.</p>
        <form id="form-eliminar-campana" class="uk-text-right" action="" method="post">
            @csrf
            @method("DELETE")
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button type="submit" class="uk-button uk-button-danger" type="button" id="btnEnviar-deleteCampana">Eliminar</button>
        </form>
    </div>
</div>


<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small uk-flex uk-flex-middle">
                <h3 class="uk-text-bold">Campañas</h3>
                <p class="uk-margin-left" style="margin-top: 0">Total: {{$numcamp}} campañas</p>
            </div>

            <div>
                <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                    style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-campana">
                    Agregar campaña
                    <span uk-icon="icon: plus" class="uk-margin-left"></span>
                </button>
            </div>
            <div class="uk-hidden@m">
                <div class="omrs-input-group">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
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
                <form action="/admin/campanas" method="get">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input name="search" />
                            <button type="submit" class="input-trail-icon" uk-icon="search"></button>
                        </label>
                    </div>
                </form>
            </div>

            <!-- Tabla -->
            <div class="uk-overflow-auto uk-padding-small">
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead class="uk-background-muted">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Candidato</th>
                            <th>Puesto</th>
                            <th>Partido Politico</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-campanas">
                        @foreach ($campanas as $camp)
                        <tr style="cursor: pointer" data-id="{{$camp->id}}">
                            <td>{{$camp->id}}</td>
                            <td>{{$camp->name}}</td>
                            <td>{{$camp->candidato}}</td>
                            <td>{{$camp->position->name}}</td>
                            <td>
                                @foreach ($camp->politic_partie as $partido)
                                @if ($loop->index==0)
                                {{$partido->siglas}}
                                @else
                                , {{$partido->siglas}}
                                @endif
                                @endforeach
                            </td>
                            <td>{{$camp->codigo}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $campanas->links() !!}
            </div>
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
            <form id="form-nueva-campana" class="uk-modal-body" action="{{ route('agregar-campana')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div uk-grid>
                    <div class="uk-width-1">
                        <div uk-grid>
                            <div class="uk-width-1">
                                <div class="avatar-wrapper uk-margin-bottom">
                                    <img id="logo" class="profile-pic uk-border-circle uk-flex"
                                        style="margin-left:auto; margin-right:auto; background-size:cover; object-fit:cover; height:200px;"
                                        src="{{asset('/img/icons/globe.png')}}" width="200" height="200"
                                        alt="Border circle" />
                                    <div id="logob" class=" uk-text-center" style="cursor: pointer">
                                        Agregar logo
                                        <span class="uk-margin-small-left" uk-icon="upload"></span>
                                    </div>
                                    <input name="fileLogo" type="file" id="fileLogo"
                                        style="visibility:hidden;height:2px;width:30px" />
                                </div>
                            </div>
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
                                        <input required type="text" name="name_cand" maxlength="255" />
                                        <span class="omrs-input-label">Nombre del candidato</span>
                                    </label>
                                </div>
                            </div>
                            {{-- INPUT DE PARTIDOS --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">PARTIDOS</h6>
                                <div id="agregar_partido" class="uk-flex uk-flex-middle uk-flex-right"
                                    style="cursor:pointer; margin-top:-15px;">
                                    <img src="{{asset('/img/icons/add.png')}}" width="10px"
                                        style="margin-right:5px;di" />
                                    <div class="uk-text-primary" style="font-size: 12px;line-height: 15px;"> Agregar
                                    </div>
                                </div>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="partido" list="partidos" type="text" name="parties" maxlength="10" />
                                        <datalist id="partidos">
                                            @foreach ($parties as $partie)
                                            <option value="{{$partie->siglas}}"></option>
                                            @endforeach
                                        </datalist>
                                    </label>
                                </div>
                                <div id="lista_partidos"
                                    class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    <input type="hidden" id="input_partidos" name="input_partidos" value="" />
                                </div>
                            </div>
                            {{-- INPUT DE AGENTES --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">AGENTES</h6>
                                <div id="agregar_agente" class="uk-flex uk-flex-middle uk-flex-right"
                                    style="cursor:pointer; margin-top:-15px;">
                                    <img src="{{asset('/img/icons/add.png')}}" width="10px"
                                        style="margin-right:5px;di" />
                                    <div class="uk-text-primary" style="font-size: 12px;line-height: 15px;"> Agregar
                                    </div>
                                </div>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="agente" list="agentes" type="text" name="agentes" maxlength="255" />
                                        <datalist id="agentes">
                                            @foreach ($agents as $agent)
                                            <option value="{{$agent->name}}"></option>
                                            @endforeach
                                        </datalist>
                                    </label>
                                </div>
                                <div id="lista_agentes"
                                    class="uk-child-width-1-3@m uk-child-width-1-4 uk-flex uk-flex-wrap">
                                    <input type="hidden" id="input_agentes" name="input_agentes" value="" />
                                </div>
                            </div>
                            {{-- SELECT DE SECCIONES --}}
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">SECCIONES</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="secciones" name="secciones" required>
                                        <option value="" disabled selected>Seleccionar secciones por:</option>
                                        <option value="1">Distrito local</option>
                                        <option value="2">Distrito federal</option>
                                        <option value="3">Municipio</option>
                                        <option value="4">Todas las secciones</option>
                                    </select>
                                </div>
                            </div>
                            <div id="locales" class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR DISTRITO LOCAL</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="local" name="local">
                                        <option value="">Selecciona un distrito local</option>
                                        @foreach($locales as $local)
                                        <option value="{{$local->id}}">{{$local->numero}}.- {{$local->cabecera}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="federales" class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR DISTRITO FEDERAL</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="federal" name="federal">
                                        <option value="">Selecciona un distrito federal</option>
                                        @foreach($federales as $federal)
                                        <option value="{{$federal->id}}">{{$federal->numero}}.- {{$federal->cabecera}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="municipios" class="uk-width-1-2@m uk-margin-medium-top" style="display:none">
                                <h6 class="uk-margin-remove uk-text-bold">POR MUNICIPIO</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" id="municipio" name="municipio">
                                        <option value="">Selecciona un municipio</option>
                                        @foreach($municipios as $municipio)
                                        <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">POSICIÓN</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select id="position" class="uk-select" required name="position" disabled>
                                        @foreach ($positions as $position)
                                        @if ($position->id != 1 && $position->id != 6)
                                        <option value="{{$position->id}}">{{$position->name}}</option>
                                        @endif
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
    $(document).ready(function () {
        var camp={!! json_encode($campanas); !!};
        var camp=camp['data'];
        $('#tabla-campanas tr').click(function(){
            var id = $(this).data('id');
            for(var key in camp){
                var obj=camp[key];
                if(obj["id"] == id){
                    break;
                }
            }
            //console.log(obj);
            $('#info-title').html('Campaña ' + obj['id']);
            if(obj['logo']){
                $("#info-foto").attr("src",'/storage/uploads/'+obj['logo']);
            }
            else{
                $("#info-foto").attr("src",'/img/icons/globe.png');
            }
            $('#info-nombre').html(obj['name']);
            $('#info-candidato').html(obj['candidato']);
            $('#info-codigo').html(obj['codigo']);
            $('#info-puesto').html(obj['position']['name']);
            var partidos='';
            obj['politic_partie'].forEach(element => {
                partidos+='<li>'+element['name']+'</li>';
            });
            $('#info-partido').html(partidos);
            var agentes='';
            obj['user'].forEach(element => {
                if(element['avatar']){
                    agentes+='<li>'+
                    '<img class="profile-pic uk-border-circle" src="/storage/uploads/' +element['avatar']+'" width="25" height="25" style="height:25px;object-fit:cover; margin-right:10px" />'
                +element['name']+'</li>';
                }
                else{
                    agentes+='<li>'+
                    '<img class="profile-pic uk-border-circle" src="/img/icons/default.png" width="25" height="25" style="height:25px;object-fit:cover; margin-right:10px" />'
                +element['name']+'</li>';
                }
            });
            $('#info-agentes').html(agentes);
            UIkit.modal("#modal-datos-camp").toggle();
            $('#ver-href').attr("href", '/admin/campana/'+id);
            $('#form-eliminar-campana').attr('action', '/admin/eliminar/campana/'+id);
        });
    });
</script>

<script>
    var arrPartidos=[];
    var arrAgentes=[];

    //Script para manejar las secciones
    $('#secciones').on('change', function() {
        $('#federales').css('display','none');
        $('#locales').css('display','none');
        $('#municipios').css('display','none');
        $('#federal').prop('required',false);
        $('#local').prop('required',false);
        $('#municipio').prop('required',false);
        $('#federal').val('');
        $('#local').val('');
        $('#municipio').val('');
        switch(this.value) {
        case '1':
            $('#locales').css('display','block').hide().show('normal');
            $('#local').prop('required',true);
            $('#position').val('5');
            break;
        case '2':
            $('#federales').css('display','block').hide().show('normal');
            $('#federal').prop('required',true);
            $('#position').val('4');
            break;
        case '3':
            $('#municipios').css('display','block').hide().show('normal');
            $('#municipio').prop('required',true);
            $('#position').val('3');
            break;
        case '4':
            $('#position').val('2');
            break;
        }
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

    //AGREGAR AGENTES
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

    //foto campaña
    jQuery(($) => {
        //esto es para la foto de campaña
        $('#logob').on('click', function() {
            $("#fileLogo").click();
        });

        function readURL(input) {
            $('#logo').attr('src', "/img/icons/globe.png");
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#fileLogo").change(function() {
            readURL(this);
        });
    });

    //ajax del form de nueva campaña
    $("#form-nueva-campana").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar-campana");

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


    //ajax del form de delete campaña
    $("#form-eliminar-campana").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar-deleteCampana");

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
                    message: '<span uk-icon=\'icon: check\'></span> Campaña eliminada con éxito!',
                    status: 'success',
                    pos: 'top-center',
                    timeout: 2000
                });
                $('#errors-campanaDelete').css('display', 'none');
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
                $('#errors-campanaDelete').css('display', 'block');
                var errors = data.responseJSON.errors;
                var errorsContainer = $('#errors-campanaDelete');
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

</script>

@endsection

@section('scripts')

@endsection