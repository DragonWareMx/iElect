@extends('layouts.layout')

@section('title')
Usuario
@endsection

@section('imports')

@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-card-title uk-text-bold">
                <a class="uk-margin-right" href="{{route('admin-usuarios')}}" uk-icon="arrow-left"></a>
                @if ($usuario->roles[0]->id==2)
                    Agente
                @endif
                @if ($usuario->roles[0]->id==1)
                    Administrador
                @endif
            </h3>
            <div class="uk-position-right uk-padding" uk-toggle="target: #modal-editar-user" uk-icon="cog" style="cursor: pointer;"></div>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-6@m"> 
                <!-- Avatar circulo -->
                <div>
                    @if($usuario->avatar)
                        <img class="uk-border-circle uk-align-center" width="100" height="100"
                        src="{{asset('storage/uploads/'.$usuario->avatar)}}" style="margin-bottom:0;height:100px; background-size:cover; object-fit:cover;" />
                    @else
                        <img class="uk-border-circle uk-align-center" width="100" height="100"
                        src="{{asset('/img/icons/default.png')}}" style="margin-bottom:0;height:100px; background-size:cover; object-fit:cover;" />
                    @endif
                </div>
            </div>
            <div class="uk-width-auto uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Nombre</div>
                <div>{{$usuario->name}}</div>
                <br />
                <div class="uk-text-bold">Correo electrónico</div>
                <div>{{$usuario->email}}</div>
                <br />
                @if ($usuario->roles[0]->id==2)
                    @php
                        $total=0;   
                    @endphp
                    @foreach($usuario->campaign as $campana)
                        @php
                            $total+=$campana->section->count();   
                        @endphp
                    @endforeach
                    @if ($total>0)
                        <div class="uk-text-bold">Secciones</div>
                        <div>{{$total}}</div>
                    @endif
                @endif
            </div>
            <div class="uk-width-auto uk-width-auto@m uk-text-left">
                @if ($usuario->roles[0]->id==2)
                    <div class="uk-text-bold">Campañas</div>
                    <div>{{$usuario->campaign->count()}}</div>
                @endif
            </div>
        </div>


        @if($usuario->roles[0]->id==2)
            <h4 class="uk-text-bold">Campañas</h4>

            <!-- Tabla -->
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead class="uk-background-muted">
                        <tr>
                            <th>Logo</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Candidato</th>
                            <th>Puesto</th>
                            <th>Partidos</th>
                            <th># Simpatizantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuario->campaign as $campana)
                        <tr>
                            <td>
                                @if($campana->logo)
                                    <img src="{{asset('storage/uploads/'.$campana->logo)}}" style="width:30px;height:30px;background-size:cover; object-fit:cover; border-radius:50%;" /> 
                                @else
                                    <img src="{{asset('img/icons/globe.png')}}" style="width:30px;height:30px;background-size:cover; object-fit:cover; border-radius:50%;" /> 
                                @endif
                            </td>
                            <td>{{$campana->codigo}}</td>
                            <td>{{$campana->name}}</td>
                            <td>{{$campana->candidato}}</td>
                            <td>{{$campana->position->name}}</td>
                            <td>
                                @foreach ($campana->politic_partie as $partido)
                                    @if ($loop->index==0)
                                    {{$partido->siglas}}
                                    @else
                                    , {{$partido->siglas}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$campana->elector->count()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <!-- Modal Editar Usuario -->
    <div id="modal-editar-user" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Editar usuario</h2>
            </div>
            <div id="errors-edit" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <form id="form-editar-usuario" class="uk-modal-body" action="{{ route('editar-usuario', ['id'=>$usuario->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div uk-grid>
                    <div class="uk-width-1">
                        <!-- Avatar -->
                        <div class="avatar-wrapper uk-margin-bottom">
                            @if($usuario->avatar)
                                <img class="uk-border-circle uk-align-center" width="200" height="200"
                                src="{{asset('storage/uploads/'.$usuario->avatar)}}" style="margin-bottom:0;height:200px; background-size:cover; object-fit:cover;" />
                            @else
                                <img class="uk-border-circle uk-align-center" width="200" height="200"
                                src="{{asset('/img/icons/default.png')}}" style="margin-bottom:0;height:200px; background-size:cover; object-fit:cover;" />
                            @endif
                            <div id="foto-edit" class=" uk-text-center" style="cursor: pointer">
                                Cambiar foto
                                <span class="uk-margin-small-left" uk-icon="upload"></span>
                            </div>
                            <input name="fileField" type="file" id="fileField-edit" style="visibility:hidden;height:2px;width:30px"/>
                        </div>
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">NOMBRE</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="name-edit" required name="name" type="text" maxlength="255"value="{{$usuario->name}}" />
                                        <span class="omrs-input-label">Nombre completo</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CORREO</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="email-edit" required type="email" autocomplete="nope" name="email" maxlength="255" value="{{$usuario->email}}"/>
                                        <span class="omrs-input-label">Correo electrónico</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m uk-text-primary uk-margin-top" style="cursor: pointer;" onclick="editarContrasena()">
                                Editar contraseña
                            </div>
                            <div class="uk-width-1-2@m hide-password uk-margin-top" style="display:none;">
                                <h6 class="uk-margin-remove uk-text-bold">ACTUAL CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input  type='password' autocomplete='new-password' id="actual-password" name="actualPassword" maxlength="255"/>
                                        <span class="omrs-input-label">Contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m hide-password uk-margin-top" style="display:none;">
                                <h6 class="uk-margin-remove uk-text-bold">NUEVA CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="password-edit"  type='password' autocomplete='new-password' name="password" onchange="validatePasswordEdit()" maxlength="255"/>
                                        <span class="omrs-input-label">Contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m hide-password uk-margin-top" style="display:none;">
                                <h6 class="uk-margin-remove uk-text-bold">CONFIRMAR CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input id="password-confirm-edit"  type='password' autocomplete='new-password' onkeyup="validatePasswordEdit()" name="password-confirm" maxlength="255"/>
                                        <span class="omrs-input-label">Confirmar contraseña</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-position-medium uk-position-bottom-left">
                    <button class="uk-button uk-button-default uk-modal-close uk-text-danger uk-text-bold" type="button" uk-toggle="target: #modal-delete">
                        Eliminar
                    </button>
                </p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button id="btnEnviar-edit" class="uk-button uk-button-primary" type="submit">
                        Enviar
                    </button>
                </p>
            </form>
        </div>
    </div>

    <!-- Modal de eliminar usuario -->
    <div id="modal-delete" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Eliminar usuario</h2>
            <div id="errors-delete" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <p>No se eliminará permanentemente el usuario, el estatus del usuario pasará a ser inactivo y éste no podrá inicar sesión.</p>
            <form id="form-eliminar-usuario" class="uk-text-right" action="{{ route('eliminar-usuario', ['id'=>$usuario->id]) }}" method="post">
                @csrf
                @method("DELETE")
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                <button type="submit" class="uk-button uk-button-danger" type="button" id="btnEnviar-delete">Eliminar</button>
            </form>
        </div>
    </div>
</div>
<script>
    //Abre los inputs de editar contraseña
    function editarContrasena(){
        $('.hide-password').css('display','block').change();
        $('#actual-password').prop('required',true);
        $('#password-edit').prop('required',true);
        $('#password-confirm-edit').prop('required',true);
    }

    function validatePasswordEdit(){
        if(passwordEdit.value != confirm_passwordEdit.value) {
            confirm_passwordEdit.setCustomValidity("Las contraseñas no coinciden");
            confirm_passwordEdit.reportValidity();
        } else {
            confirm_passwordEdit.setCustomValidity('');
            confirm_passwordEdit.reportValidity();
        }
    }

    //Cambia la foto seleccionada del edit de perfil en la vista
    jQuery(($) => {
        //esto es para la foto de perfil
        $('#foto-edit').on('click', function() {
            $("#fileField-edit").click();
        });

        function readURL(input) {
            $('#avatar-edit').attr('src', "/img/icons/default.png");
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#avatar-edit').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#fileField-edit").change(function() {
            readURL(this);
        });
    });


    //ajax del form de editar
    $("#form-editar-usuario").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar-edit");

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
                    message: '<span uk-icon=\'icon: check\'></span> Usuario editado con éxito!',
                    status: 'success',
                    pos: 'top-center',
                    timeout: 2000
                });
                $('#errors-edit').css('display', 'none');
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
                $('#errors-edit').css('display', 'block');
                var errors = data.responseJSON.errors;
                var errorsContainer = $('#errors-edit');
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

    //ajax del form de eliminar
    $("#form-eliminar-usuario").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar-delete");

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
                    message: '<span uk-icon=\'icon: check\'></span> Usuario eliminado con éxito!',
                    status: 'success',
                    pos: 'top-center',
                    timeout: 2000
                });
                $('#errors-delete').css('display', 'none');
                setTimeout(
                function()
                {
                    window.location.href='/admin/usuarios';
                }, 2000);
            },
            error: function(data){
                console.log(data);
                // $('#success').css('display', 'none');
                btnEnviar.removeAttr("disabled");
                $('#errors-delete').css('display', 'block');
                var errors = data.responseJSON.errors;
                var errorsContainer = $('#errors-delete');
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