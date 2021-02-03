@extends('layouts.layout')

@section('title')
Cuenta
@endsection

@section('imports')
<!-- CSS Avatar -->
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" />
@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title uk-text-bold">
            <a class="uk-margin-right" href="{{route('ajustes')}}" uk-icon="arrow-left"></a>Cuenta
        </h3>
        @if (session()->get('status'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <ul>
                <li>{{session()->get('status')}}</li>
            </ul>
        </div>
        @endif
        @if ($errors->any())
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('cuentaUpdateAdmin', ['id'=>auth()->user()->id])}}"  method="POST" id="formCheckPassword" enctype="multipart/form-data">
            @method("PATCH")
                    @csrf
            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                <div class="uk-width-auto uk-width-auto@m">
                    <!-- Avatar circulo -->
                    <div class="avatar-wrapper">
                        @if(Auth::user()->avatar !=NULL)
                                <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{asset('storage/avatar/'.Auth::user()->avatar)}}" width="200" height="200"
                                    alt="Foto" />
                        @else
                            <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{asset('img/test/default.png')}}" width="200" height="200"
                                    alt="Foto" />
                        @endif
                        <div class="upload-text">
                            <a id="foto-edit" class="uk-link-reset uk-flex uk-flex-center uk-flex-middle uk-margin-auto uk-width-1 uk-flex-wrap uk-text-small" style="width:max-content;">
                                <span uk-icon="icon: upload; ratio: 0.8" style="margin-right:5px"></span>Editar foto</a>
                            <input name="fileField" type="file" id="fileField_edit" style="visibility:hidden;height:2px;width:30px" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                    <div class="omrs-input-group uk-margin-bottom">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="text" name="nombre" id="nombre" required value="{{Auth::user()->name}}"/>
                            <span class="omrs-input-label">Nombre completo</span>
                        </label>
                    </div>
                    <a href="javascript:editarPass();">Cambiar contraseña</a>
                </div>
                <div id="chg_pass" class="uk-width-auto uk-width-1-4@m uk-text-left" style="display: none">
                    <div class="omrs-input-group uk-margin-bottom">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password"  name="passActual" id="passActual" onchange="this.setAttribute('value', this.value);" />
                            <span class="omrs-input-label">Contraseña actual</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password"  name="password" id="password"  onchange="this.setAttribute('value', this.value); validatePasswordEdit(); validatePasswordLength();"/>
                            <span class="omrs-input-label">Nueva contraseña</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password" name="cfmPassword" id="cfmPassword"  onchange="this.setAttribute('value', this.value);" onkeyup="validatePasswordEdit()"/>
                            <span class="omrs-input-label">Cambiar contraseña</span>
                        </label>
                    </div>
                </div>
            </div>

            <p class="uk-text-right">
                <a href="javascript:history.back(-1);" class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </a>
                <input class="uk-button uk-button-primary" type="submit" value="Guardar">
            </p>
        </form>
    </div>
</div>
<script>
    div = document.getElementById('chg_pass');
    passActual = document.getElementById('passActual');
    password = document.getElementById('password');
    cfmPassword = document.getElementById('cfmPassword');
    function editarPass(){
        if(div.style.display=='none'){
            div.style.display='block';
            passActual.required=true;
            password.required=true;
            cfmPassword.required=true;
        }else{
            div.style.display='none';
            passActual.value='';
            password.value='';
            cfmPassword.value='';
            passActual.required=false;
            password.required=false;
            cfmPassword.required=false;
        }
    }


    // Confirmar que las contraseñas sean iguales
    var password_edit = document.getElementById("password")
        , confirm_password_edit = document.getElementById("cfmPassword");

    function validatePasswordEdit(){
        if(password_edit.value != confirm_password_edit.value) {
            confirm_password_edit.setCustomValidity("Las contraseñas no coinciden");
            confirm_password_edit.reportValidity();
        } else {
            confirm_password_edit.setCustomValidity('');
            confirm_password_edit.reportValidity();
        }
    }
    jQuery(($) => {
             //esto es para la foto de perfil
            $('#foto-edit').on('click', function() {
                $("#fileField_edit").click();
            });
            $('#avatar-edit').on('click', function() {
                $("#fileField_edit").click();
            });

            // Cargar la foto a img
            function readURLEdit(input) {
                $('#avatar-edit').attr('src', "/img/test/default.png");
                

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('#avatar-edit').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#fileField_edit").change(function() {
                readURLEdit(this);
            });
    });
</script>
@endsection