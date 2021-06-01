@extends('template.layout')

@section('head')
@parent
{!! Html::style('plugins/datatables/datatables.min.css') !!}
{!! Html::style('plugins/datatables/Buttons/css/buttons.dataTables.min.css') !!}
@stop


@section('content')
	<div class="container">


        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h2>OMS - ASSIST V3.0</h2>
                <a href="{{ '/index/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB/' }}" ><button type="button" class="btn btn-default "><i class="fa fa-home"></i> Ir al inicio</button></a>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <br>
        <form method="GET" id="form_rips" action="/estadisticas/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha inicial</label>
                        <input type="text" name="periodo_inicial" id="periodo_inicial" value="{{  (!empty( $_GET["periodo_inicial"] )?   $_GET["periodo_inicial"]  : null )    }}" placeholder="Fecha Inicial" class="form-control datepickerui" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha final</label>
                        <input type="text" name="periodo_final" placeholder="Fecha Final" id="periodo_final" value="{{ (!empty( $_GET["periodo_final"] )?   $_GET["periodo_final"]  : null )   }}" class="form-control datepickerui" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empresa</label>
                            {!! Form::text('empresa',(!empty($_GET["empresa"])? $_GET["empresa"] : null) ,["class"=>"form-control","id"=>"empresa", "placeholder" => "Empresa"]) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cargo</label>
                            {!! Form::text('cargo',(!empty($_GET["cargo"])? $_GET["cargo"] : null) ,["class"=>"form-control","id"=>"cargo", "placeholder" => "Cargo"]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                       <div class="form-group">
                           <label> &nbsp;</label>
                           <button class="btn btn-primary btn-block" id="btn-buscar"><span class="glyphicon glyphicon-search"></span> GENERAR</button>
                           {!! Form::hidden('filtrar',1) !!}
                       </div> 
                   </div>
               </div>
            </div>
        </form>

        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h4>Estadísticas</h4>
                <p>
                    Estadísticas relevantes del cuestionario:						
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Relación de consumo de sustancias:</h5>
                    </div>
                    <div class="box-body">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="pieChartContainer">
                                  <canvas width="500" height="200" id="chartSustancias"></canvas>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Promedio de puntaje por sustancia:</h5>
                    </div>
                    <div class="box-body">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="pieChartContainer">
                                  <canvas width="500" height="200" id="chartPromedio"></canvas>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Pacientes con riesgo alto por sustancia:</h5>
                    </div>
                    <div class="box-body">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="pieChartContainer">
                                  <canvas width="500" height="200" id="chartRiesgoAlto"></canvas>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Pacientes con riesgo moderado por sustancia:</h5>
                    </div>
                    <div class="box-body">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="pieChartContainer">
                                  <canvas width="500" height="200" id="chartRiesgoModerado"></canvas>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Pacientes con riesgo bajo por sustancia:</h5>
                    </div>
                    <div class="box-body">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="pieChartContainer">
                                  <canvas width="500" height="200" id="chartRiesgoBajo"></canvas>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
    </div>
@endsection


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>


<script type="text/javascript">
	var labelsDrogas = ['Tabaco','Bebidas alcohólicas', 'Cannabis', 'Cocaína', 
    'Anfetaminas', 'Inhalantes', 
    'Tranquilizantes', 'Alucinógenos', 'Opiáceos', 'Otras'];
	var dataDrogas = [];
    var colorsDrogas = [];
    var dataPromedio = [];
    var dataRiesgoAlto = [];
    var dataRiesgoModerado = [];
    var dataRiesgoBajo = [];
    var key;
	function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>


@foreach($drogas_corto as $key => $value)
    <script>
        colorsDrogas.push(getRandomColor());
        dataDrogas.unshift(0);
        dataPromedio.unshift(0);
        dataRiesgoAlto.unshift(0);
        dataRiesgoModerado.unshift(0);
        dataRiesgoBajo.unshift(0);
    </script>
@endforeach

@foreach($respuestas as $respuesta)
    @foreach($respuesta->consumidas as $key => $value)
        <script>
            key = parseInt('{{$key}}',10) - 1;
            dataDrogas[key] = dataDrogas[key] + parseInt('{{$value}}',10);
        </script>
    @endforeach

    @foreach($respuesta->results as $key => $value)
        <script>
            key = parseInt('{{$key}}',10) - 1;
            dataPromedio[key] = dataPromedio[key] + parseInt('{{$value}}',10);
        </script>
    @endforeach

    @foreach($respuesta->riesgo as $key => $value)
        @if($value == "Alto")
            <script>
                key = parseInt('{{$key}}',10) - 1;
                dataRiesgoAlto[key]++;
            </script>
        @endif
        @if($value == "Moderado")
            <script>
                key = parseInt('{{$key}}',10) - 1;
                dataRiesgoModerado[key]++;
            </script>
        @endif
        @if($value == "Bajo")
            <script>
                key = parseInt('{{$key}}',10) - 1;
                dataRiesgoBajo[key]++;
            </script>
        @endif
    @endforeach

@endforeach

<script>
    var len = dataPromedio.length;
    for(var i = 0; i < len; i++)
        dataPromedio[i] = dataPromedio[i] / len;

    console.log(dataPromedio);
</script>






<style>
    .container{
        width: 80%;
    }
</style>



@section('footer')
@parent
{!! Html::script('plugins/switchery/switchery.js') !!}
{!! Html::script('plugins/datatables/datatables.min.js') !!}
{!! Html::script('plugins/datatables/DataTables/dataTables.bootstrap.min.js') !!} 
{!! Html::script('plugins/datatables/Buttons/js/dataTables.buttons.min.js') !!} 
{!! Html::script('plugins/datatables/Buttons/js/buttons.print.min.js') !!}
{!! Html::script('plugins/datatables/Buttons/js/buttons.flash.min.js') !!}
<script type="text/javascript">
    var graphic = 
		{
			type:"doughnut",
			data: {
				labels: labelsDrogas,
				datasets:[{
					label: "Sustancia",
					data: dataDrogas,
					backgroundColor: colorsDrogas,
					hoverOffset: 4
				}
				]
			},
		}
		var chartDrogas = document.getElementById('chartSustancias').getContext('2d');
		window.pie = new Chart(chartDrogas,graphic);


    var graphic = 
		{
			type:"bar",
			data: {
				labels: labelsDrogas,
				datasets:[{
					label: "Promedio de puntaje",
					data: dataPromedio,
					backgroundColor: colorsDrogas,
				}
				]
			},
		}
		var chartDrogas = document.getElementById('chartPromedio').getContext('2d');
		window.pie = new Chart(chartDrogas,graphic);

    var graphic = 
		{
			type:"doughnut",
			data: {
				labels: labelsDrogas,
				datasets:[{
					label: "Pacientes con riesgo alto",
					data: dataRiesgoAlto,
					backgroundColor: colorsDrogas,
					hoverOffset: 4
				}
				]
			},
		}
		var chartDrogas = document.getElementById('chartRiesgoAlto').getContext('2d');
		window.pie = new Chart(chartDrogas,graphic);

    var graphic = 
		{
			type:"doughnut",
			data: {
				labels: labelsDrogas,
				datasets:[{
					label: "Pacientes con riesgo moderado",
					data: dataRiesgoModerado,
					backgroundColor: colorsDrogas,
					hoverOffset: 4
				}
				]
			},
		}
		var chartDrogas = document.getElementById('chartRiesgoModerado').getContext('2d');
		window.pie = new Chart(chartDrogas,graphic);

    var graphic = 
		{
			type:"doughnut",
			data: {
				labels: labelsDrogas,
				datasets:[{
					label: "Pacientes con riesgo bajo",
					data: dataRiesgoBajo,
					backgroundColor: colorsDrogas,
					hoverOffset: 4
				}
				]
			},
		}
		var chartDrogas = document.getElementById('chartRiesgoBajo').getContext('2d');
		window.pie = new Chart(chartDrogas,graphic);
    
</script>
@stop

