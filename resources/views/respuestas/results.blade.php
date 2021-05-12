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
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h4>Resultados</h4>
                <p>
                    Gracias por responder las preguntas. Sus puntajes son los siguientes:						
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
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
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <h3>¿Qué significan sus puntuaciones?</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Riesgo</th>
                            <th>Significado</th>
                        </thead>
                        <tbody>
                            @foreach($combo_significados as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col col-lg-2"></div>
        <div class="col col-lg-2">
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
