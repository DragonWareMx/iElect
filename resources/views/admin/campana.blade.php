@extends('layouts.layout')

@section('title')
Campañas
@endsection

@section('imports')

@endsection

@section('body')


<div class="uk-margin uk-margin-left uk-margin-right uk-flex uk-flex-wrap">
    <!-- Modal Datos campaña -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top  uk-width-1">
        <div uk-grid>
            <div class="uk-width-1 uk-flex uk-flex-wrap">
                <!-- Avatar -->
                <div class="avatar-wrapper uk-margin-medium-right uk-width-1-6@m">
                    @if ($campana->logo)
                        <img class="profile-pic uk-border-circle" src="{{asset('storage/uploads/'.$campana->logo)}}" style="height:150px;object-fit:cover;" width="150"
                        height="150" alt="Border circle" id="info-foto" />
                    @else
                        <img class="profile-pic uk-border-circle" src="{{asset('img/icons/globe.png')}}" width="150"
                        height="150" alt="Border circle" id="info-foto"  style="height:150px;object-fit:cover;"/>
                    @endif
                </div>
                <!--Grid DATOS-->
                <div uk-grid>
                    <div class="uk-width-expand@m">
                        <div class="uk-text-bold">Nombre Campaña</div>
                        <div id="info-nombre">{{$campana->name}}</div>
                        <br />
                        <div class="uk-text-bold">Candidato</div>
                        <div id="info-candidato">{{$campana->candidato}}</div>
                        <br />
                        <div class="uk-text-bold">Puesto</div>
                        <div id="info-puesto">{{$campana->position->name}}</div>
                        <br />
                        <div class="uk-text-bold">Código</div>
                        <div id="info-codigo">{{$campana->codigo}}</div>
                        <br />
                    </div>
                    <div class="uk-width-1-2@m">
                        <div class="uk-text-bold">Partido político</div>
                        <div>
                            <ul id="info-partido">
                                @foreach ($campana->politic_partie as $partie)
                                    <li>{{$partie->name}} ({{$partie->siglas}})</li>
                                @endforeach
                            </ul>
                        </div>
                        <br />
                        <div class="uk-text-bold">Agentes</div>
                        <div>
                            <ul id="info-agentes">
                                @foreach ($campana->user as $agent)
                                    @if ($agent->avatar)
                                    <li><img class="profile-pic uk-border-circle " src="/storage/uploads/{{$agent->avatar}}"  width="30" height="30" style="height:30px;object-fit:cover; margin-right:10px" alt=""> {{$agent->name}}</li>
                                    @else
                                    <li><img class="profile-pic uk-border-circle " src="/img/icons/default.png"  width="30" height="30" style="height:30px;object-fit:cover; margin-right:10px" alt=""> {{$agent->name}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <button class="uk-button uk-button-danger uk-padding-small uk-padding-remove-top uk-padding-remove-bottom" style="margin-left:auto;margin-right:0px;" type="submit" uk-toggle="target: #modal-delete">
                Eliminar
            </button>
        </div>
    </div>

    <div id="modal-delete" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Eliminar campaña</h2>
            <div id="errors-campanaDelete" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <p>Los datos de la campaña y los electores relacionados a ésta se eliminarán de forma permanente.</p>
            <form id="form-eliminar-campana" class="uk-text-right" action="/admin/eliminar/campana/{{$campana->id}}" method="post">
                @csrf
                @method("DELETE")
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button type="submit" class="uk-button uk-button-danger" type="button" id="btnEnviar-deleteCampana">Eliminar</button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="uk-overflow-auto uk-padding-small uk-width-1">
        <table class="uk-table uk-table-small uk-table-divider">
            <thead class="uk-background-muted">
                <tr>
                    <th>Número de sección</th>
                    <th>Municipio</th>
                    <th>Distrito federal</th>
                    <th>Distrito local</th>
                    <th>Meta</th>
                    <th>Prioridad</th>
                </tr>
            </thead>
            <tbody id="tabla-secciones">
                @foreach ($secciones as $seccion)
                <tr style="cursor: pointer" data-id="{{$seccion->pivot->id}}" data-num={{$seccion->id}}>
                    <td>{{$seccion->num_seccion}}</td>
                    <td>{{$seccion->town->nombre}}</td>
                    <td>{{$seccion->federal_district->cabecera}}</td>
                    <td>{{$seccion->local_district->cabecera}}</td>
                    <td>{{$seccion->pivot->meta}}</td>
                    <td>{{$seccion->pivot->prioridad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $secciones->links() !!}
    </div>

    <!-- Modal Editar Seccion -->
    <div id="modal-editar-seccion" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 id="seccionId" class="uk-modal-title">Editar sección # de esta campáña</h2>
            </div>
            <div id="errors-seccion" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <form id="form-editar-seccion" class="uk-modal-body" action="" method="POST">
                @csrf
                @method('PATCH')
                <div uk-grid>
                    <div class="uk-width-1">
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">Meta de la campaña en esta sección</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="meta" required name="meta" type="number" />
                                        <span class="omrs-input-label">Meta</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">Prioridad de la campaña en esta sección</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select id="prioridad" class="uk-select" required name="prioridad" style="height:56px;">
                                        <option value="Alta">Alta</option>
                                        <option value="Media">Media</option>
                                        <option value="Baja">Baja</option>
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
                    <button id="btnEnviar-seccion" class="uk-button uk-button-primary" type="submit">
                        Enviar
                    </button>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    //Mandar datos de la sección al modal
    $(document).ready(function () {
        var camp={!! json_encode($secciones); !!};
        var camp=camp['data'];
        $('#tabla-secciones tr').click(function(){
            var data=$(this).data('num');
            for(var key in camp){
                var obj=camp[key];
                if(obj["id"] == data){
                    break;
                }
            }
            $('#seccionId').html('Editar sección '+ obj['num_seccion'] +' de esta campaña');
            $('#meta').val(obj['pivot']['meta']);
            $('#prioridad').val(obj['pivot']['prioridad']);
            $('#form-editar-seccion').attr('action', '/admin/editar/seccion/'+obj['pivot']['id']);
            UIkit.modal("#modal-editar-seccion").toggle();
            
        });
    });

    //AJAX ELIMINAR CAMPÄÑA
     jQuery(($) => {
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
                        window.location.href='/admin/campanas';
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
     });

     //AJAX EDITAR SECCION DE CAMPAÑA
     jQuery(($) => {
         //ajax del form de editar sección
        $("#form-editar-seccion").bind("submit",function(){
            // Capturamnos el boton de envío
            var btnEnviar = $("#btnEnviar-seccion");

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
                        message: '<span uk-icon=\'icon: check\'></span> Sección editada con éxito!',
                        status: 'success',
                        pos: 'top-center',
                        timeout: 2000
                    });
                    $('#errors-seccion').css('display', 'none');
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
                    $('#errors-seccion').css('display', 'block');
                    var errors = data.responseJSON.errors;
                    var errorsContainer = $('#errors-seccion');
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
     });


</script>

@endsection