@extends('layouts.layout')

@section('title')
Usuarios
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@section('body')
<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small" uk-grid style="display: flex; align-items: center">
                <div>
                    <h3 class="uk-card-title uk-text-bold">Administradores</h3>
                </div>
                <div>
                    <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                        style="
                justify-content: center;
                align-items: center;
                display: flex;
                max-height: 55px !important;
              " uk-toggle="target: #modal-agregar-user">
                        Agregar agente
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
                        Agregar agente
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
            </div>

            <!-- Sección ADMINISTRADORES -->
            <div class="uk-padding-small uk-grid-column-small uk-grid-row-large uk-child-width-1-4@s" uk-grid
                style="margin-top: 0 !important">
                @foreach ($administradores as $admin)
                    <a href="{{ route('admin-usuario', ['id'=>$admin->id]) }}" style="text-decoration:none;">
                        <div class="editar-admin" style="cursor: pointer;">
                            <!-- Tarjeta administrador -->
                            <div class="uk-card uk-card-default uk-padding-small">
                                <div uk-grid>
                                    <div class="uk-width-auto@m">
                                        <div>
                                            @if($admin->avatar)
                                                <img class="uk-border-circle uk-align-center" width="100" height="100"
                                                src="{{asset('storage/uploads/'.$admin->avatar)}}" style="margin-bottom:0;height:100px; background-size:cover; object-fit:cover;" />
                                            @else
                                                <img class="uk-border-circle uk-align-center" width="100" height="100"
                                                    src="{{asset('/img/icons/default.png')}}" style="margin-bottom:0;height:100px; background-size:cover; object-fit:cover;" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-width-expand@m">
                                        <p class="uk-text-bold uk-margin-remove-bottom uk-text-center uk-text-left@m uk-text-truncate">
                                            {{$admin->name}}
                                        </p>
                                        <p class="uk-text-meta uk-margin-remove-top uk-text-center uk-text-left@m uk-text-truncate"
                                            style="margin: 0">
                                            {{$admin->email}}
                                        </p>
                                        @if ($admin->status == 'activo')
                                            <div class="uk-margin-small-top uk-text-center uk-align-center uk-align-left@m" style="
                                            background-color: #62d69e;
                                            color: white;
                                            border-radius: 4px;
                                            width: fit-content;
                                            min-width: 6rem;
                                            ">
                                                <p style="padding: 2px; margin: 0">Activo</p>
                                            </div>
                                        @else 
                                            <div class="uk-margin-small-top uk-text-center uk-align-center uk-align-left@m" style="
                                            background-color: #F4E55D;
                                            color: white;
                                            border-radius: 4px;
                                            width: fit-content;
                                            min-width: 6rem;
                                            ">
                                                <p style="padding: 2px; margin: 0">Inactivo</p>
                                            </div>
                                        @endif
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Card Datos de la sección -->
    <div class="uk-card uk-card-default uk-padding-small">
        <!-- Graficas -->
        <div uk-grid class="">
            <!-- Grafica de barras -->
            <div class="uk-width-expand@m">
                <!-- Tabla Agentes-->
                <h3 class="uk-text-bold">Agentes</h3>
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-small uk-table-divider">
                        <thead class="uk-background-muted">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo electrónico</th>
                                <th>Campañas</th>
                                <th>Secciones</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agentes as $agente)
                                <tr class="editar-agente">
                                    <td> <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">#{{$agente->id}}</a></td>
                                    <td> <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">{{$agente->name}}</a></td>
                                    <td> <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">{{$agente->email}}</a></td>
                                    <td>
                                        <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">
                                        @foreach($agente->campaign as $campana)
                                            @if ($loop->index==0)
                                            {{$campana->name}}
                                            @else
                                            , {{$campana->name}}
                                            @endif
                                        @endforeach
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $total=0;   
                                        @endphp
                                        @foreach($agente->campaign as $campana)
                                            @php
                                                $total+=$campana->section->count();   
                                            @endphp
                                        @endforeach
                                        <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">{{$total}}</a>
                                    </td>
                                    <td class="uk-text-capitalize"> <a class="uk-text-muted" href="{{ route('admin-usuario', ['id'=>$agente->id]) }}" style="text-decoration:none;">{{$agente->status}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de BRIGADISTAS -->
    <div class="uk-card uk-card-default uk-padding-small">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">Brigadistas</h3>
        </div>
        <!-- Tabla -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="uk-background-muted">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo electronico</th>
                        <th>Campaña</th>
                        <th>Simpatizantes registrados</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brigadistas as $brigadista)
                        <tr class="editar-brigadista">
                            <td>{{$brigadista->id}}</td>
                            <td>{{$brigadista->name}}</td>
                            <td>{{$brigadista->email}}</td>
                            <td>
                                @foreach($brigadista->campaign as $campana)
                                    @if ($loop->index==0)
                                    {{$campana->name}}
                                    @else
                                    , {{$campana->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$brigadista->elector->count()}}
                            </td>
                            <td class="uk-text-capitalize">{{$brigadista->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Agregar Usuario -->
    <div id="modal-agregar-user" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Agregar agente</h2>
            </div>
            <div id="errors" class="uk-alert-danger" uk-alert style="display:none;">
            </div>
            <form id="form-nuevo-usuario" class="uk-modal-body" action="{{ route('agregar-usuario')}}" method="POST" enctype="multipart/form-data">
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
                                        <input required type='password' autocomplete='new-password' id="password" name="password" onchange="validatePassword()" maxlength="255"/>
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
</div>
<script>
    //Validar contraseña 
    var password = document.getElementById("password")
    , confirm_password = document.getElementById("password-confirm");

    var passwordEdit = document.getElementById("password-edit")
    , confirm_passwordEdit = document.getElementById("password-confirm-edit");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Las contraseñas no coinciden");
            confirm_password.reportValidity();
        } else {
            confirm_password.setCustomValidity('');
            confirm_password.reportValidity();
        }
    }

    //Cambia la foto seleccionada de perfil en la vista
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

    //ajax del form de nuevo
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
</script>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
UIkit.modal("#modal-datos-simp").toggle();
}

//Subir imagen
var bar = document.getElementById("js-progressbar");

UIkit.upload(".js-upload", {
url: "",
multiple: true,

beforeSend: function () {
console.log("beforeSend", arguments);
},
beforeAll: function () {
console.log("beforeAll", arguments);
},
load: function () {
console.log("load", arguments);
},
error: function () {
console.log("error", arguments);
},
complete: function () {
console.log("complete", arguments);
},

loadStart: function (e) {
console.log("loadStart", arguments);

bar.removeAttribute("hidden");
bar.max = e.total;
bar.value = e.loaded;
},

progress: function (e) {
console.log("progress", arguments);

bar.max = e.total;
bar.value = e.loaded;
},

loadEnd: function (e) {
console.log("loadEnd", arguments);

bar.max = e.total;
bar.value = e.loaded;
},

completeAll: function () {
console.log("completeAll", arguments);

setTimeout(function () {
bar.setAttribute("hidden", "hidden");
}, 1000);

alert("Upload Completed");
},
});

//Grafica de pastel Ocupaciones
//Grafica de pastel
var ocupCanvas = document.getElementById("ocupChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var ocupData = {
labels: [
"Estudiantes",
"Vigilantes",
"Contratistas",
"Hogar",
"Profesores",
"Otros",
],
datasets: [
{
data: [25, 3, 10, 4, 56, 2],
backgroundColor: [
"#FFD43A",
"#04BE65",
"#2D9B94",
"#007AFF",
"#C8194B",
"#ADADAD",
],
},
],
};

var ocupChart = new Chart(ocupCanvas, {
type: "pie",
data: ocupData,
});
@endsection