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
                <a href="{{ '/estadisticas/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB/' }}" ><button type="button" class="btn btn-success">Ver estadísticas</button></a>
                <a href="{{ '/detalle/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB/' }}" ><button type="button" class="btn btn-success">Detalle sustancia/riesgo</button></a>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h4>Resultados</h4>
                <p>
                    A continuación, se encuentra la lista de resultados de los diferentes usuarios:						
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table data-sortcols='{"0":"asc","1":"asc"}' class="table datatables_tools table-striped">
                        <thead>
                            <th># Documento</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo electrónico</th>
                            <th>Ciudad</th>
                            <th>Empresa</th>
                            <th>Cargo</th>
                            <th>Fecha y hora</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach($respuestas as $respuesta)
                                <tr>
                                    <td>{{ (!empty($respuesta->usuario->documento)? $respuesta->usuario->documento : null) }}</td>
                                    <td>{{ $respuesta->usuario->nombre }}</td>
                                    <td>{{ $respuesta->usuario->telefono }}</td>
                                    <td>{{ $respuesta->usuario->email }}</td>
                                    <td>{{ (!empty($respuesta->usuario->ciudad)? $respuesta->usuario->ciudad : null) }}</td>
                                    <td>{{ (!empty($respuesta->usuario->empresa)? $respuesta->usuario->empresa : null) }}</td>
                                    <td>{{ (!empty($respuesta->usuario->cargo)? $respuesta->usuario->cargo : null) }}</td>
                                    <td>{{ $respuesta->updated_at }}</td>
                                    <td>
                                        <a href="{{ '/show/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB/' . $respuesta->id }}" ><button type="button" class="btn btn-default "><i class="fa fa-eye"></i> </button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col col-lg-2"></div>
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
{!! Html::script('js/jquery.validate.min.js') !!}
{!! Html::script('js/jquery.dataTables.min.js') !!}
{!! Html::script('js/dataTables.bootstrap.min.js') !!} 
{!! Html::script('js/dataTables.buttons.min.js') !!} 
{!! Html::script('js/jszip.min.js') !!}
{!! Html::script('js/pdfmake.min.js') !!}
{!! Html::script('js/vfs_fonts.js') !!}
{!! Html::script('js/buttons.html5.min.js') !!} 
{!! Html::script('js/buttons.colVis.min.js') !!}
@stop

<style>
    .container{
        width: 80%;
    }
</style>
