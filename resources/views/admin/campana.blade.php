@extends('layouts.layout')

@section('title')
Campañas
@endsection

@section('imports')

@endsection

@section('body')

<!-- Modal Datos campaña -->
<div class="uk-margin uk-margin-left uk-margin-right uk-flex ">
    <div class="uk-card uk-card-default uk-card-body uk-margin-top  uk-width-1">
        <div uk-grid>
            <div class="uk-width-1 uk-flex">
                <!-- Avatar -->
                <div class="avatar-wrapper uk-margin-medium-right">
                    @if ($campana->logo)
                        <img class="profile-pic uk-border-circle" src="{{asset('storage/uploads/'.$campana->logo)}}" width="150"
                        height="150" alt="Border circle" id="info-foto" style="object-fit:cover" />
                    @else
                        <img class="profile-pic uk-border-circle" src="{{asset('img/icons/globe.png')}}" width="150"
                        height="150" alt="Border circle" id="info-foto" style="object-fit:cover" />
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
</div>

<script>
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
</script>

@endsection