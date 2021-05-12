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
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h3>Resultados de {{ $respuesta->usuario->nombre }}</h3>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <h2>Pregunta 1</h2>
                    <p>
                        A lo largo de su vida, ¿cuál/es de las siguientes sustancias ha consumido 
                        <strong>alguna vez</strong>? (SOLO PARA USOS NO-MÉDICOS)				
                    </p>
                    <table class="table table-striped">
                        <tbody>
                            @foreach($drogas_corto as $key => $row)
                                <tr>
                                    <td>{{ $row }}</td>
                                    <td>
                                        {{($respuesta->consumidas->$key == 1 ? 'Sí' : 'No')}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>

        @if(!empty($respuesta->pregunta_2))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 2</h2>
                        <p>
                            En los últimos tres meses, ¿con qué frecuencia ha consumido las 
                            sustancias que mencionó?					
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_frecuencia[$respuesta->segunda->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif

        @if(!empty($respuesta->pregunta_3))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 3</h2>
                        <p>
                            En los últimos tres meses, ¿con qué frecuencia ha tenido deseos fuertes 
                        o ansias de consumir?					
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_frecuencia[$respuesta->tercera->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif

        @if(!empty($respuesta->pregunta_4))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 4</h2>
                        <p>
                            En los últimos tres meses, ¿con qué frecuencia le ha llevado su 
                        consumo de las/s siguiente/s sustancias a problemas de salud, sociales, 
                        legales o económicos?					
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_frecuencia[$respuesta->cuarta->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif


        @if(!empty($respuesta->pregunta_5))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 5</h2>
                        <p>
                            En los últimos tres meses, ¿con qué frecuencia dejó de 
                        hacer lo que se esperaba de usted habitualmente por el consumo de 
                        la/s siguiente/s sustancias/s?					
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_frecuencia[$respuesta->quinta->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif


        @if(!empty($respuesta->pregunta_6))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 6</h2>
                        <p>
                            ¿Un amigo, un familiar o alguien más alguna vez
                        ha mostrado preocupación por su consumo de la/s siguiente/s sustancias/s?						
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_afirmacion[$respuesta->sexta->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif


        @if(!empty($respuesta->pregunta_7))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 7</h2>
                        <p>
                            ¿Ha intentado alguna vez controlar, reducir o dejar de consumir 
                        la/s siguiente/s sustancias/s y no lo ha logrado?						
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                @foreach($respuesta->consumidas as $key => $row)
                                    <tr>
                                        @if($row == 1)
                                            <td>{{ $drogas_corto[$key] }}</td>
                                            <td>{{ $combo_afirmacion[$respuesta->septima->$key] }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif


        @if(!empty($respuesta->pregunta_8))
            <div class="row">
                <div class="col-md-auto">
                    <div class="table-responsive">
                        <h2>Pregunta 8</h2>
                        <p>
                            ¿Ha consumido alguna vez alguna droga por vía inyectada? 
                        (ÚNICAMENTE PARA USOS NO MÉDICOS)					
                        </p>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>{{ $combo_afirmacion[$respuesta->pregunta_8] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-2"></div>
            </div>
        @endif

        
        <br>
        <div class="row">
            <div class="col-md-auto">
                <h1>Puntajes</h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Sustancia</th>
                            <th>Puntaje</th>
                            <th>Riesgo</th>
                        </thead>
                        <tbody>
                            @foreach($respuesta->consumidas as $key => $row)
                                <tr>
                                    <td>{{ $drogas_corto[$key] }}</td>
                                    <td>{{ $respuesta->results->$key }}</td>
                                    <td>{{ $respuesta->riesgo[$key] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection


@section('footer')
@parent
{!! Html::script('plugins/switchery/switchery.js') !!}
{!! Html::script('plugins/datatables/datatables.min.js') !!}
{!! Html::script('plugins/datatables/DataTables/dataTables.bootstrap.min.js') !!} 
{!! Html::script('plugins/datatables/Buttons/js/dataTables.buttons.min.js') !!} 
{!! Html::script('plugins/datatables/Buttons/js/buttons.print.min.js') !!}
{!! Html::script('plugins/datatables/Buttons/js/buttons.flash.min.js') !!}
@stop

<style>
    .container{
        width: 80%;
    }
</style>
