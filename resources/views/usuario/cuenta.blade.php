@extends('layouts.layout')

@section('title')
Cuenta
@endsection

@section('imports')
<link rel="stylesheet" href="{{asset('css/usuario/cuenta.css')}}" /> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
@endsection

@section('body')

<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title uk-text-bold">
            <a class="uk-margin-right" href="{{route('ajustes')}}" uk-icon="arrow-left"></a>Cuenta
        </h3>

        <form action="{{route('cuentaUpdate', ['id'=>auth()->user()->id])}}"  method="POST" id="formCheckPassword" enctype="multipart/form-data">
            @method("PATCH")
                    @csrf
            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                <div class="uk-width-auto uk-width-auto@m">
                    <!-- Avatar circulo -->
                    <div class="avatar-wrapper">
                        @if(Auth::user()->avatar !=NULL)
                            <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{auth()->user()->avatar}}" width="200" height="200"
                                alt="Foto" />
                        @else
                            <img class="profile-pic uk-border-circle" id="avatar-edit" src="{{asset('img/test/default.png')}}" width="200" height="200"
                                    alt="Foto" />
                        @endif
                        <div class="upload-text">
                            <a id="foto-edit" class="uk-link-reset uk-flex uk-flex-center uk-flex-middle uk-margin-auto uk-width-1 uk-flex-wrap uk-text-small" style="width:max-content;">
                            <span uk-icon="icon: upload; ratio: 0.8" style="margin-right:5px"></span>Editar foto</a>
                            {{-- Editar foto
                            <span class="uk-margin-small-left" uk-icon="upload"></span> --}}
                            <input name="fileField" type="file" id="fileField_edit" style="visibility:hidden;height:2px;width:30px">
                        </div>
                    </div>  
                </div>
                <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                    {{-- @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                    <div class="uk-text-primary">Cambiar contraseña</div>

                    <div class="omrs-input-group uk-margin-bottom">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password"  name="passActual" id="passActual" required onchange="this.setAttribute('value', this.value);" />
                            <span class="omrs-input-label">Contraseña actual</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password"  name="password" id="password" required onchange="this.setAttribute('value', this.value); validatePasswordEdit(); validatePasswordLength();"/>
                            <span class="omrs-input-label">Nueva contraseña</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input type="password" name="cfmPassword" id="cfmPassword" required onchange="this.setAttribute('value', this.value);" onkeyup="validatePasswordEdit()"/>
                            <span class="omrs-input-label">Confirmar contraseña</span>
                        </label>
                    </div>
                </div>
            </div>

            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </button>
                <input class="uk-button uk-button-primary" type="submit" value="Guardar">
            </p>
        </form>
    </div>
</div>
<script>
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