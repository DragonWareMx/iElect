@extends('layouts.layout')

@section('title')
Mapa seccional
@endsection

@section('imports')
@extends('subviews.chartjs')
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAsRsMlBifyC8uKaJMAskmREIdfLqBYyA&callback=initMap&libraries=&v=weekly"
defer></script>

@endsection
@php
    if (session()->get('campana')->position->id == 2){
        $anio = 1;
    }
    else{
        $anio =2;
    }
@endphp
@section('body')
<body onload="setYear({{$anio}})">
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-margin-top uk-padding-small">
        <div class="uk-flex uk-flex-middle">
            <h3 class="uk-text-bold uk-margin-remove">Mapa seccional</h3>
            @if (!isset($dFederales) && !isset($dLocales))
            <a href="#" class="uk-margin-left" onclick="opciones('municipio')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/section.png')}}"
                    style="max-height: 24px; max-width: 24px; width: 100%;" />
                Municipios
            </a>
            
            @elseif (!isset($dFederales) && !isset($municipios))
            <a href="#" class="uk-margin-left" onclick="opciones('local')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mich.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos locales
            </a> 
            
            @elseif (!isset($dLocales) && !isset($municipios))
            <a href="#" class="uk-margin-left" onclick="opciones('federal')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mexico.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos federales
            </a>
            @else
            <a href="#" class="uk-margin-left" onclick="opciones('federal')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mexico.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos federales
            </a>
            <a href="#" class="uk-margin-left" onclick="opciones('local')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mich.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos locales
            </a>
            <a href="#" class="uk-margin-left" onclick="opciones('municipio')">
                <img class="uk-margin-small-right" src="{{asset('img/icons/section.png')}}"
                    style="max-height: 24px; max-width: 24px; width: 100%;" />
                Municipios
            </a>
            @endif

        </div>

        <div class="uk-child-width-expand@s uk-margin" uk-grid>
            <div class="uk-width-auto uk-width-1-4@m">
                <h6 class="uk-margin-remove uk-text-bold">ENTIDAD FEDERATIVA</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select-edo" disabled>
                        @foreach ($estados as $estado)
                            @if ($estado->id == 16)
                            <option value="{{$estado->id}}" selected>{{$estado->nombre}}</option>    
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                
                @if (!isset($dFederales) && !isset($dLocales))
                <div id="municipio" style="display: none" class="uk-animation-slide-top-medium">
                    <h6 class="uk-margin-remove uk-text-bold">MUNICIPIO</h6>
                    <div class="uk-margin-bottom">
                        <div class="uk-form-controls">
                            <select class="uk-select" id="form-stacked-select-mp" onchange="drawSections(this.value, 'municipio')">
                                <option value="" selected="selected" >Selecciona un municipio</option>
                    
                                <option value="{{$municipios->id}}&{{$municipios->local_district[0]->coordenadas}}">{{$municipios->nombre}}</option>    
                                
                            </select>
                        </div>
                    </div>
                </div>

                @elseif (!isset($dFederales) && !isset($municipios))
                <div id="local" style="display: none" class="uk-animation-slide-top-medium">
                    <h6 class="uk-margin-remove uk-text-bold">DISTRITO LOCAL</h6>
                        <div class="uk-margin-bottom">
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-stacked-select-dl" onchange="drawSections(this.value, 'local')">
                                    <option value="" selected="selected" >Selecciona un distrito</option>
                                
                                    <option value="{{$dLocales->id}}&{{$dLocales->coordenadas}}">{{$dLocales->id}}-{{$dLocales->cabecera}}</option>    
                                
                                </select>
                            </div>
                        </div>
                </div>
                @elseif (!isset($dLocales) && !isset($municipios))
                <div id="federal" class="uk-animation-slide-top-medium" style="display: none">
                    <h6 class="uk-margin-remove uk-text-bold">DISTRITO FEDERAL</h6>
                    <div class="uk-margin-bottom">
                        <div class="uk-form-controls">
                            <select id="selectDF" class="uk-select" id="form-stacked-select-df" onchange="drawSections(this.value, 'federal')">
                                <option value="" selected="selected">Selecciona un distrito</option>
                                
                                    <option value="{{$dFederales->id}}&{{$dFederales->coordenadas}}" >{{$dFederales->id}}-{{$dFederales->cabecera}}</option>    
                               
                            </select>
                        </div>
                    </div>
                </div>
                @else  

                <div id="federal" class="uk-animation-slide-top-medium" style="display: none">
                    <h6 class="uk-margin-remove uk-text-bold">DISTRITO FEDERAL</h6>
                    <div class="uk-margin-bottom">
                        <div class="uk-form-controls">
                            <select id="selectDF" class="uk-select" id="form-stacked-select-df" onchange="drawSections(this.value, 'federal')">
                                <option value="" selected="selected">Selecciona un distrito</option>
                                @foreach ($dFederales as $distrito)
                                    <option value="{{$distrito->id}}&{{$distrito->coordenadas}}" >{{$distrito->id}}-{{$distrito->cabecera}}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="local" style="display: none" class="uk-animation-slide-top-medium">
                <h6 class="uk-margin-remove uk-text-bold">DISTRITO LOCAL</h6>
                    <div class="uk-margin-bottom">
                        <div class="uk-form-controls">
                            <select class="uk-select" id="form-stacked-select-dl" onchange="drawSections(this.value, 'local')">
                                <option value="" selected="selected" >Selecciona un distrito</option>
                            @foreach ($dLocales as $distrito)
                                <option value="{{$distrito->id}}&{{$distrito->coordenadas}}">{{$distrito->id}}-{{$distrito->cabecera}}</option>    
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="municipio" style="display: none" class="uk-animation-slide-top-medium">
                    <h6 class="uk-margin-remove uk-text-bold">MUNICIPIO</h6>
                    <div class="uk-margin-bottom">
                        <div class="uk-form-controls">
                            <select class="uk-select" id="form-stacked-select-mp" onchange="drawSections(this.value, 'municipio')">
                                <option value="" selected="selected" >Selecciona un municipio</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{$municipio->id}}&{{$municipio->local_district[0]->coordenadas}}">{{$municipio->nombre}}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <h6 class="uk-margin-remove uk-text-bold">SECCIÓN</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select-sc" onchange="slSection(this.value)">
                            <option value="" selected="selected">Secciones</option>
                        </select>
                    </div>
                </div>
                <hr />
                <form action="/seccion_mapa" id="form-ajax">
                    <div class="uk-flex">
                        <p class="uk-margin-small-right uk-text-bold">Meta 2021: </p>
                        <p id="label_meta" class="uk-margin-remove"></p>
                    </div>
                    <div class="uk-flex">
                        <p class="uk-margin-small-right uk-text-bold">Avance: </p>
                        <p id="label_avance" class="uk-margin-remove"></p>
                    </div>
                    <div class="uk-flex">
                        <p class="uk-margin-small-right uk-text-bold">Prioridad: </p>
                        <p id="label_prioridad" class="uk-text-danger uk-margin-remove"></p>
                    </div>
                    <!-- GRAFICA SEXO -->
                    <h5 class="uk-margin-remove uk-text-bold">LISTADO NOMINAL</h5>
                    <div class="uk-flex">
                        <p class="uk-margin-small-right uk-text-bold">Total: </p>
                        <p id="totalLN" class="uk-margin-remove"></p>
                    </div>
                    <h5 class="uk-text-bold uk-margin-remove" style="padding-top: 0">
                        Sexo
                    </h5>
                    <div class="uk-flex uk-flex-middle">
                        <div id="div_pie">
                            <canvas id="simpChart" width="auto" height="200"></canvas>
                        </div>
                        <div id="porcentajes" class="uk-flex uk-flex-middle" style="display: none">
                            <div>
                                <span class="uk-badge" style="background-color: #9b51e0"></span>
                                <p id="men"></p> 
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #fb8832"></span>
                                <p id="women"></p>
                            </div>
                        </div>
                            
                    </div>
                    <div id="moreInfo" class="uk-text-right" style="display:none">
                        <a class="uk-text-small info" uk-toggle="target: .info">Más información <span
                                uk-icon="icon: chevron-right; ratio: 0.8"></span></a>
                    </div>
                </form>    
            </div>
            <div class="uk-width-expand@m info">
                <!--MAPA SECCIONAL-->
                <h1 id="section">MAPA</h1>
                <div id="mapa" style="height: 100%" style=""> 
                </div>
                
                
                {{-- Aquí cargamos el mapa --}}
                 
            </div>
            <div id="div_graphics" class="uk-width-expand@m info" hidden>
                <!--GRÁFICAS-->
                <h2 id="seccionName"></h2>
                <p class="uk-text-bold">Edad</p>
                <canvas id="barChart" width="auto" height="200" style="max-height: 250px"></canvas>
                <p id="before_me" class="uk-text-center uk-text-small uk-margin-remove">Rango de edades</p>
                <hr />
                <p class="uk-text-bold">Información histórica</p>
                <div class="uk-margin-top uk-text-center elec_resp" style="top: -50px; position: relative;">
                    <div class=" uk-flex-inline uk-flex-middle">
                        
                        @if (session()->get('campana')->position->id == 2)
                        <p class="uk-margin-remove uk-text-bold">Elecciones 2015</p>
                        @elseif (session()->get('campana')->position->id == 1 || session()->get('campana')->position->id == 6)
                        <p class="uk-margin-remove uk-text-bold">Elecciones 2018</p>
                        @else
                        <a id="atras" href="#" uk-icon="chevron-left" onclick="elecciones(this.id)"></a>
                        <p id="label_elec" class="uk-margin-remove uk-text-bold">Elecciones 2018</p>
                        <a id="adelante" href="#" uk-icon="chevron-right" onclick="elecciones(this.id)" style="display: none"></a>
                        @endif

                    </div>
                    <p class="uk-margin-remove">{{session()->get('campana')->position->name}}</p>
                </div>
                <div class="uk-margin-top" uk-grid>
                    <!-- Grafica de barras -->
                    <div id="div_barHistoric" class="uk-width-1-2@m">
                        <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                        <canvas id="barHistoric" width="auto" height="200" style="max-height: 200px"></canvas>
                        <p id="before_me2" class="uk-text-center uk-text-small uk-margin-remove">Partidos políticos</p>
                    </div>

                    <div class="uk-width-expand@m">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>Partido</th>
                                        <th>#Votos</th>
                                        <th>Puesto por sección</th>
                                    </tr>
                                </thead>
                                <tbody id="tableVotes">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="uk-text-right">
                    <a class="uk-text-small" uk-toggle="target: .info"><span
                            uk-icon="icon: chevron-left; ratio: 0.8"></span> Menos información</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
@endsection

@section('scripts')
let map;
var secOp;
let control; //guarda el tipo de distrito o muni de las secciones visibles
let idControl; //guarda el id del distrito o muni de las secciones visibles
let click=false;
let year; //año de la eleccion para histórico
let nombre; //id de la sección 

function setYear(anio){
    
year =anio; 

}

function callSection(idSection){//método para jalar info de sección de la bd, se llama dentro de dos funciones init map, en el evento click y en slSection

httpRequest = false;
if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
    httpRequest = new XMLHttpRequest();
    
} else {
// Internet explorer siempre llevando la contra.
    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}
if (httpRequest == false) return false; // no se puedo crear el objeto

var ide = idSection; // obtener el id de la sección
var url = document.getElementById('form-ajax').action;
httpRequest.open('GET', url + '/' + ide + '/' + year, true);


httpRequest.onreadystatechange = function() {
            
    if (httpRequest.readyState == 4) {
        // la peticion la recibio el servidor
        if (httpRequest.status == 200) {
            // convertimos la respuesta del servidor a un objeto JSON
            respuesta = JSON.parse(httpRequest.responseText);

            selectedSc = respuesta.seccion;
            total =  selectedSc.hombres + selectedSc.mujeres;
            avance = respuesta.simpatizantes;
            
            document.getElementById('label_meta').innerHTML = respuesta.meta;
            document.getElementById('label_prioridad').innerHTML = respuesta.prioridad;
            document.getElementById('label_avance').innerHTML = avance;
            
            //Grafica de pastel 
            var simpCanvas = document.getElementById("simpChart");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.legend.display = false;

            simpData = {
            labels: ["Hombres", "Mujeres"],
            datasets: [
            {
            data: [selectedSc.hombres,selectedSc.mujeres],
            backgroundColor: ["#9B51E0", "#FB8832"],
            },
            ],
            };

            let pieChart = new Chart(simpCanvas, {
            type: "pie",
            data: simpData,
            });
            
            document.getElementById("totalLN").innerHTML = total;
            porcentajeH = parseInt((selectedSc.hombres*100)/total);
            porcentajeM = parseInt((selectedSc.mujeres*100)/total);
            document.getElementById('men').innerHTML = 'H '+porcentajeH +'%';
            document.getElementById('women').innerHTML = 'M '+porcentajeM +'%';

            //Grafica de barras
            var ctx = document.getElementById("barChart").getContext("2d");
            var barChart = new Chart(ctx, {
            type: "bar",
            data: {
            labels: [
            "18",
            "19",
            "20-24",
            "25-29",
            "30-34",
            "35-39",
            "40-44",
            "45-49",
            "50-54",
            "55-59",
            "60-64",
            "65 o más",
            ],
            datasets: [
            {
            label: "Electores",
            data: [selectedSc['0'],selectedSc['1'],selectedSc['20_24'],selectedSc['25_29'],selectedSc['30_34'],
                    selectedSc['35_39'],selectedSc['40_44'], selectedSc['45_49'],selectedSc['50_54'],selectedSc['55_59'],
                    selectedSc['60_64'], selectedSc['65_mas']],
            backgroundColor: "rgba(0,122,255,1)",
            },
            ],
            },
            options: {
            maintainAspectRatio: false,
            },
            });
            //Grafica de barras
            Chart.defaults.global.legend.display = false;
            var ctx = document.getElementById("barHistoric").getContext("2d");
            var barHistoric = new Chart(ctx, {
            type: "bar",
            data: {
            labels: respuesta.partidos,
            datasets: [
            {
            label: "Votos",
            data: respuesta.num,
            backgroundColor: respuesta.colores,
            },
            ],
            },
            options: {
            maintainAspectRatio: false,
            },
            });
            //borro resultados anteriores de tabla
            tabla = document.getElementById('tableVotes');
            tabla.innerHTML='';

            //lleno tabla de resultados
            
            for (i in respuesta.partidos) {
                if (respuesta.num[i]==0) break;
                place = parseInt(i)+1;
                tabla.innerHTML+='<tr> <td>' + respuesta.partidos[i] + '</td> <td>' + respuesta.num[i] + '</td> <td>' + place + '</td> </tr>';
            }

        } else {
            alert("Error de la consulta a la Base de datos"); //poner el error correcto 
            // error 404, 500 etc.
        }   
    }
}
httpRequest.send();  
}

function elecciones(direccion){
if (direccion == 'atras'){
    document.getElementById('atras').style.display = 'none';
    document.getElementById('adelante').style.display ='block';
    document.getElementById('label_elec').innerHTML = 'Elecciones 2015';
    year-=1;
    callSection(nombre);
}
else{
    document.getElementById('adelante').style.display = 'none';
    document.getElementById('atras').style.display ='block';
    document.getElementById('label_elec').innerHTML = 'Elecciones 2018';
    year+=1;
    callSection(nombre);
}
}
function initMap() {
map = new google.maps.Map(document.getElementById("mapa"), {
    center:
    { lat: 19.7036519, lng: -101.2411436 },
    zoom: 9,
});

map.data.loadGeoJson('js/MICHOACAN_SECCION.geojson');

map.data.setStyle({
    visible: false,
});


map.data.addListener('click', function(event) {
    document.getElementById('porcentajes').style.display = 'block';
    document.getElementById('moreInfo').style.display = 'block';

    if(!click){
        document.getElementById("simpChart").remove();
        var canvas = document.createElement("canvas");
        canvas.id = "simpChart"; 
        canvas.style.height='200';
        canvas.style.width='auto';
        canvas.style.maxHeight='250px';
        document.getElementById('div_pie').appendChild(canvas);//creo y elimino elementos html de los canvas para que no se superpongan al actualizar

        document.getElementById("barChart").remove();
        var canvas = document.createElement("canvas");
        canvas.id = "barChart"; 
        canvas.style.height='200';
        canvas.style.width='auto';
        canvas.style.maxHeight='250px';
        before_me =document.getElementById("before_me");
        document.getElementById('div_graphics').insertBefore(canvas, before_me );//creo y elimino divs grafica de edad

        document.getElementById("barHistoric").remove();
        var canvas = document.createElement("canvas");
        canvas.id = "barHistoric"; 
        canvas.style.height='200';
        canvas.style.width='auto';
        canvas.style.maxHeight='200px';
        before_me =document.getElementById("before_me2");
        document.getElementById('div_barHistoric').insertBefore(canvas, before_me );//creo y elimino divs grafica de votos

        nombre = event.feature.getProperty('Name');
        document.getElementById('seccionName').innerHTML = 'Sección ' + nombre;
        map.data.setStyle(function(feature) {//le pongo el color a la seccion del mapa cliqueada
            var ide = feature.getProperty('Name');
            var ver = ide == nombre ? true : false; 
            
            return {
            strokeWeight: 1,
            fillOpacity: 0.3,
            visible: ver,
            };
        });
        //map.data.overrideStyle(event.feature, {fillColor: 'green', strokeColor:'white'});
        callSection(nombre);  
        click=true;
    }
    else{
        map.data.setStyle(function(feature) {
            var distrito = feature.getProperty(control);
            var ver = distrito == idControl ? true : false; 
            return {
            strokeWeight: 1,
            fillOpacity: 0.3,
            visible: ver,
            };
        });
        click=false;
    }
    // coordinates = event.feature.getGeometry();
    // var Latlng = new google.maps.LatLng(coordinates[[0]]);

    // var infoWindow = new google.maps.InfoWindow({
    //     content: description,
    //     position: Latlng,
    // });
            
    // infoWindow.open(map);
});

map.data.addListener('mouseover', function(event) {
    var nombre = event.feature.getProperty('Name');
    document.getElementById("section").innerHTML = "Sección "+nombre;

    map.data.revertStyle();
    map.data.overrideStyle(event.feature, {fillColor: 'blue', strokeColor:'white'});
});

}

function opciones(tipo){
switch(tipo){
    case "federal":
        document.getElementById("federal").style.display ='block';
        document.getElementById("local").style.display ='none';
        document.getElementById("municipio").style.display ='none';
    break;
    case "local":
        document.getElementById("local").style.display ='block';
        document.getElementById("federal").style.display ='none';
        document.getElementById("municipio").style.display ='none';
    break;
    case "municipio":
        document.getElementById("municipio").style.display ='block';
        document.getElementById("local").style.display ='none';
        document.getElementById("federal").style.display ='none';
    break;
}    
}

function drawSections(vars, caso){
paquete =vars.split('&');
ident =paquete[0];
coord =paquete[1].split(',');
mylat =parseFloat(coord[0]);
mylng =parseFloat(coord[1]);
idControl=ident;
click=false;
map.setCenter({ lat: mylat, lng: mylng });

switch (caso){
    case "federal":
    control='DISTRITO'; 
    //dibujo las secciones del mapa
    secOp="";
    map.data.setStyle(function(feature) {
        var distrito = feature.getProperty('DISTRITO');
        var ver = distrito == ident ? true : false; 
        return {
        strokeWeight: 1,
        fillOpacity: 0.3,
        visible: ver,
        };
    });
    //llamo las secciones correspondientes al distrito de la bd
    httpRequest = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
        httpRequest = new XMLHttpRequest();
        
    } else {
    // Internet explorer siempre llevando la contra.
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (httpRequest == false) return false; // no se puedo crear el objeto
    
    var url = "/dF_mapa"
    httpRequest.open('GET', url + '/' + ident, true);
      
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4) {
            // la peticion la recibio el servidor
            if (httpRequest.status == 200) {
                // convertimos la respuesta del servidor a un objeto JSON
                respuesta = JSON.parse(httpRequest.responseText);
                // obtenemos secciones
                secciones =respuesta.secciones;
                for (i in secciones) {
                secOp += '<option value="' + secciones[i].id + '">'+ secciones[i].id + '</option>';
                }
                document.getElementById('form-stacked-select-sc').innerHTML=secOp;
            } else {
                alert("Error"); //poner el error correcto 
                // error 404, 500 etc.
            }       
        }
    }
    httpRequest.send();
    break;
    case "local": 
    control='DISTRITO_L';
    secOp="";
    map.data.setStyle(function(feature) {
        var distrito = feature.getProperty('DISTRITO_L');
        var ver = distrito == ident ? true : false; 
        return {
        strokeWeight: 1,
        fillOpacity: 0.3,
        visible: ver,
        };
    });
    //llamo las secciones correspondientes al distrito de la bd
    httpRequest = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
        httpRequest = new XMLHttpRequest();
        
    } else {
    // Internet explorer siempre llevando la contra.
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (httpRequest == false) return false; // no se puedo crear el objeto
    
    var url = "/dL_mapa"
    httpRequest.open('GET', url + '/' + ident, true);
      
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4) {
            // la peticion la recibio el servidor
            if (httpRequest.status == 200) {
                // convertimos la respuesta del servidor a un objeto JSON
                respuesta = JSON.parse(httpRequest.responseText);
                // obtenemos secciones
                secciones =respuesta.secciones;
                for (i in secciones) {
                secOp += '<option value="' + secciones[i].id + '">'+ secciones[i].id + '</option>';
                }
                document.getElementById('form-stacked-select-sc').innerHTML=secOp;
            } else {
                alert("Error"); //poner el error correcto 
                // error 404, 500 etc.
            }       
        }
    }
    httpRequest.send();
    break;
    
    case "municipio": 
    control='MUNICIPIO';
    secOp="";
    map.data.setStyle(function(feature) {
        var municipio = feature.getProperty('MUNICIPIO');
        var ver = municipio == ident ? true : false; 
        return {
        strokeWeight: 1,
        fillOpacity: 0.3,
        visible: ver,
        };
    });
    //llamo las secciones correspondientes al distrito de la bd
    httpRequest = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
        httpRequest = new XMLHttpRequest();
        
    } else {
    // Internet explorer siempre llevando la contra.
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (httpRequest == false) return false; // no se puedo crear el objeto
    
    var url = "/mN_mapa"
    httpRequest.open('GET', url + '/' + ident, true);
      
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4) {
            // la peticion la recibio el servidor
            if (httpRequest.status == 200) {
                // convertimos la respuesta del servidor a un objeto JSON
                respuesta = JSON.parse(httpRequest.responseText);
                // obtenemos secciones
                secciones =respuesta.secciones;
                for (i in secciones) {
                secOp += '<option value="' + secciones[i].id + '">'+ secciones[i].id + '</option>';
                }
                document.getElementById('form-stacked-select-sc').innerHTML=secOp;
            } else {
                alert("Error"); //poner el error correcto 
                // error 404, 500 etc.
            }       
        }
    }
    httpRequest.send();
    break;
} 
}

function slSection(sc){
document.getElementById("section").innerHTML = "Sección "+ sc;
document.getElementById('porcentajes').style.display = 'block';
document.getElementById('moreInfo').style.display = 'block';

document.getElementById("simpChart").remove();
var canvas = document.createElement("canvas");
canvas.id = "simpChart"; 
canvas.style.height='200';
canvas.style.width='auto';
canvas.style.maxHeight='250px';
document.getElementById('div_pie').appendChild(canvas);//creo y elimino elementos html de los canvas para que no se superpongan al actualizar

document.getElementById("barChart").remove();
var canvas = document.createElement("canvas");
canvas.id = "barChart"; 
canvas.style.height='200';
canvas.style.width='auto';
canvas.style.maxHeight='250px';
before_me =document.getElementById("before_me");
document.getElementById('div_graphics').insertBefore(canvas, before_me );//creo y elimino divs grafica de edad

document.getElementById("barHistoric").remove();
var canvas = document.createElement("canvas");
canvas.id = "barHistoric"; 
canvas.style.height='200';
canvas.style.width='auto';
canvas.style.maxHeight='200px';
before_me =document.getElementById("before_me2");
document.getElementById('div_barHistoric').insertBefore(canvas, before_me );//creo y elimino divs grafica de votos

nombre = sc;
document.getElementById('seccionName').innerHTML = 'Sección ' + nombre;
map.data.setStyle(function(feature) {//le pongo el color a la seccion del mapa cliqueada y oculto las demás
    var ide = feature.getProperty('Name');
    var ver = ide == nombre ? true : false; 
    var color = ide == nombre ? 'blue': 'none';
    return {
    strokeWeight: 1,
    fillOpacity: 0.3,
    visible: ver,
    fillColor: color,
    };
});

callSection(nombre); //esta función jala la info de la bd     
click=true;  
}
@endsection