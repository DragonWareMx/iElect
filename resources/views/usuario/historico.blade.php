@extends('layouts.layout')

@section('title')
Histórico
@endsection

@section('imports')
@extends('subviews.chartjs')
<link rel="stylesheet" href="{{asset('css/usuario/historico.css')}}" />
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
<body onload="firstLoad({{$secciones[0]->id}},{{$anio}})">
    
<div class="uk-margin uk-margin-left uk-margin-right" >
    <!-- CARD HISTORICO -->
    <div class="uk-card uk-card-default uk-padding-small">
        <h3>Histórico</h3>
        <div class="">
            <!-- SELECT -->
            <div class="uk-width-large">
                <div class="select">
                    <select class="select-text" required onchange="callSection(this.value)">
                        <option value="" disabled selected></option>
                        @foreach ($secciones as $seccion)
                            <option value="{{$seccion->id}}">{{$seccion->id}}-{{$seccion->town->nombre}}</option>
                        @endforeach    
                    </select>
                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label id="labelSelect" class="select-label">Sección</label>
                </div>
            </div>
            <!-- SELECCION ELECCIONES -->
            <div class="uk-margin-top uk-text-center elec_resp" style="top: -70px; position: relative;">
                <div class="uk-flex-inline uk-vertical-align-middle">
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
        </div>
        <div class="uk-margin-top" uk-grid>
            <!-- Grafica de barras -->
            <div id="dadBar" class="uk-width-1-2@m">
                <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                <canvas id="barChart" width="auto" height="200"></canvas>
            </div>
            <div class="uk-width-expand@m">
            </div>
            <div class="uk-width-1-3@m">
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
    </div>
    <!-- CARDS PROMEDIO y RESULTADOS -->
    <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-2@m">
            <div class="uk-card uk-card-default uk-padding-small">
                <h5 class="uk-margin-remove uk-text-bold">Votos</h5>
                <p class="uk-margin-remove">Todas las candidaturas</p>
                <div class="uk-margin-top" uk-grid>
                    <!-- Grafica de pastel -->
                    <div class="">
                        <div class="uk-flex uk-flex-middle">
                            <div id="daddyChart" class="uk-margin-large-right">
                                
                                <canvas id="ocupChart" width="auto" height="400"></canvas>
                                <small id="before_me" class="uk-text-center" style="width: max-content;">Promedio obtenido por partido</small>
                            </div>
                            <div id="porcentajes" class="uk-flex-none uk-margin-large-left" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@m">
            <div class="uk-card uk-card-default uk-padding-small">
                <h5 class="uk-margin-remove uk-text-bold">Ganadores por puesto</h5>
                <p class="uk-margin-remove">Todas las candidaturas</p>
                <div class="uk-margin-top" uk-grid>
                    <div class="uk-width-expand@m">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>Partido</th>
                                        <th>#Votos</th>
                                        <th>Candidatura</th>
                                    </tr>
                                </thead>
                                <tbody id="tableW">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="uk-width-1-4@m"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
<script>
    let year; //año de elección
    let nombre;//id de la sección seleccionada

    function firstLoad(sc,anio){
        year = anio;
        nombre = sc;
        callSection(sc);
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
    
    function callSection(ide){
        nombre = ide;
        httpRequest = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
            httpRequest = new XMLHttpRequest();
            
        } else {
        // Internet explorer siempre llevando la contra.
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (httpRequest == false) return false; // no se puedo crear el objeto
        
        httpRequest.open('GET', '/historico_seccion/' + ide +'/'+ year, true);
        
        httpRequest.onreadystatechange = function() {
            porcentajes = document.getElementById('porcentajes');
            tabla2= document.getElementById('tableW');
            tabla = document.getElementById('tableVotes');
            
            
            tabla.innerHTML='';
            tabla2.innerHTML='';
            porcentajes.innerHTML='';

            document.getElementById("ocupChart").remove();
            var canvas = document.createElement("canvas");
            canvas.id = "ocupChart"; 
            canvas.style.height='400';
            canvas.style.width='auto';
            before = document.getElementById('before_me');
            document.getElementById('daddyChart').insertBefore(canvas, before);        
            
            document.getElementById("barChart").remove();
            var canvas = document.createElement("canvas");
            canvas.id = "barChart"; 
            canvas.style.height='200';
            canvas.style.width='auto';
            document.getElementById('dadBar').appendChild(canvas); 
            
            if (httpRequest.readyState == 4) {
                // la peticion la recibio el servidor
                if (httpRequest.status == 200) {
                    // convertimos la respuesta del servidor a un objeto JSON
                    respuesta = JSON.parse(httpRequest.responseText);
                    
                    
                    //Grafica de pastel 
                    var simpCanvas = document.getElementById("ocupChart");
                    Chart.defaults.global.defaultFontFamily = "Lato";
                    Chart.defaults.global.defaultFontSize = 18;
                    Chart.defaults.global.legend.display = false;

                    simpData = {
                    labels: respuesta.partidos,
                    datasets: [
                    {
                    data: respuesta.promedios,
                    backgroundColor: respuesta.colores,
                    },
                    ],
                    };

                    let pieChart = new Chart(simpCanvas, {
                    type: "pie",
                    data: simpData,
                    });
                    
                    //puntitos de porcentaje promedios
                    
                    
                    for (i in respuesta.partidos){
                        if (respuesta.promedios[i]!=0){
                            porcentajes.innerHTML+=  '<div> <span class="uk-badge" style="background-color:'+respuesta.colores[i]+'"></span>'+
                            respuesta.partidos[i]+' '+respuesta.promedios[i]+'</div>';
                        }
                    }
                    //tabla de ganadores por puesto
                    console.log(respuesta);
                    for (i in respuesta.puestos) {
                        tabla2.innerHTML+='<tr> <td>' + respuesta.ganadores[i] + '</td> <td>' 
                        + respuesta.voteWin[i] + '</td> <td>' + respuesta.puestos[i] + '</td> </tr>';
                    }

                    //Grafica de barras
                    Chart.defaults.global.legend.display = false;
                    var ctx = document.getElementById("barChart").getContext("2d");
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
</script>
@section('scripts')

@endsection