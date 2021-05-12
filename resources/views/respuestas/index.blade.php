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
                    A continuación, se encuentra la lista de resultados de los diferentes usuarios:						
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo electrónico</th>
                            <th>Fecha y hora</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach($respuestas as $respuesta)
                                <tr>
                                    <td>{{ $respuesta->usuario->nombre }}</td>
                                    <td>{{ $respuesta->usuario->telefono }}</td>
                                    <td>{{ $respuesta->usuario->email }}</td>
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
@stop

<style>
    .container{
        width: 80%;
    }
</style>
