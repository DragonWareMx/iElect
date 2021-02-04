@extends('layouts.layout')

@section('title')
Histórico
@endsection

@section('imports')
@extends('subviews.chartjs')
<link rel="stylesheet" href="{{asset('css/usuario/historico.css')}}" />
@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
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
                    <label class="select-label">Sección</label>
                </div>
            </div>
            <!-- SELECCION ELECCIONES -->
            <div class="uk-margin-top uk-text-center elec_resp" style="top: -70px; position: relative;">
                <div class="uk-flex-inline uk-vertical-align-middle">
                    <a href="" uk-icon="chevron-left"></a>
                    <p class="uk-margin-remove uk-text-bold">Elecciones 2015</p>
                    <a href="" uk-icon="chevron-right"></a>
                </div>
                <p class="uk-margin-remove">Gobernador estatal de Michoacán</p>
            </div>
        </div>
        <div class="uk-margin-top" uk-grid>
            <!-- Grafica de barras -->
            <div class="uk-width-1-2@m">
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
                <h5 class="uk-margin-remove uk-text-bold">Histórico</h5>
                <p class="uk-margin-remove">Todas las candidaturas</p>
                <div class="uk-margin-top" uk-grid>
                    <!-- Grafica de pastel -->
                    <div class="uk-width-1-2@m">
                        <div class="uk-flex uk-flex-middle">
                            <div>
                                <canvas id="ocupChart" width="auto" height="200"></canvas>
                                <small class="uk-text-center" style="width: max-content;">Promedio obtenido por partido</small>
                            </div>
                            <div class="uk-flex-none">
                                <div>
                                    <span class="uk-badge" style="background-color: #ffd43a"></span>
                                    PRI 25%
                                </div>
                                <div>
                                    <span class="uk-badge" style="background-color: #04be65"></span>
                                    PAN 3%
                                </div>
                                <div>
                                    <span class="uk-badge" style="background-color: #2d9b94"></span>
                                    PT 10%
                                </div>
                                <div>
                                    <span class="uk-badge" style="background-color: #007aff"></span>
                                    NDP 4%
                                </div>
                                <div>
                                    <span class="uk-badge" style="background-color: #c8194b"></span>
                                    PES 56%
                                </div>
                                <div>
                                    <span class="uk-badge" style="background-color: #adadad"></span>
                                    Otros 2%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@m">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>Partido</th>
                                        <th>Promedio obtenido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>PRI</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>PAN</td>
                                        <td>35%</td>
                                    </tr>
                                    <tr>
                                        <td>PT</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>NDP</td>
                                        <td>%</td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="uk-pagination uk-flex-center" uk-margin>
                                <li><a href="#"><span uk-pagination-previous></span></a></li>
                                <li><a href="#">1</a></li>
                                <li class="uk-disabled"><span>...</span></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li class="uk-active"><span>7</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#"><span uk-pagination-next></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@m">
            <div class="uk-card uk-card-default uk-padding-small">
                <h5 class="uk-margin-remove uk-text-bold">Histórico</h5>
                <p class="uk-margin-remove">Todas las candidaturas</p>
                <div class="uk-margin-top" uk-grid>
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
                                <tbody>
                                    <tr>
                                        <td>NDP</td>
                                        <td>183</td>
                                        <td>Primer lugar</td>
                                    </tr>
                                    <tr>
                                        <td>PRI</td>
                                        <td>#</td>
                                        <td>Segundo lugar</td>
                                    </tr>
                                    <tr>
                                        <td>PAN</td>
                                        <td>#</td>
                                        <td>Tercer lugar</td>
                                    </tr>
                                    <tr>
                                        <td>NDP</td>
                                        <td>#</td>
                                        <td>Cuarto lugar</td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="uk-pagination uk-flex-center" uk-margin>
                                <li><a href="#"><span uk-pagination-previous></span></a></li>
                                <li><a href="#">1</a></li>
                                <li class="uk-disabled"><span>...</span></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li class="uk-active"><span>7</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#"><span uk-pagination-next></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-width-1-4@m"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function callSection(ide){
        httpRequest = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari, Chrome etc.
            httpRequest = new XMLHttpRequest();
            
        } else {
        // Internet explorer siempre llevando la contra.
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (httpRequest == false) return false; // no se puedo crear el objeto
        
        httpRequest.open('GET', '/historico_seccion/' + ide, true);
        
        
        httpRequest.onreadystatechange = function() {
                    
            if (httpRequest.readyState == 4) {
                // la peticion la recibio el servidor
                if (httpRequest.status == 200) {
                    // convertimos la respuesta del servidor a un objeto JSON
                    respuesta = JSON.parse(httpRequest.responseText);
                    selectedSc = respuesta.seccion;
                    total =  selectedSc.hombres + selectedSc.mujeres;
                    
                    //Grafica de pastel 
                    var simpCanvas = document.getElementById("ocupChart");
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
</script>
@section('scripts')

@endsection