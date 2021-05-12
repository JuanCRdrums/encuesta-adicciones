@extends('template.layout')

@section('head')
@parent
{!! Html::style('plugins/datatables/datatables.min.css') !!}
{!! Html::style('plugins/datatables/Buttons/css/buttons.dataTables.min.css') !!}
@stop


@section('content')
{!! Form::open(array('url' => '/store-4/' . $respuesta->id)) !!}
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
                <h4>Pregunta 4</h4>
                <p>
                    En los últimos tres meses, ¿con qué frecuencia le ha llevado su 
                    consumo de las/s siguiente/s sustancias a problemas de salud, sociales, 
                    legales o económicos?
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($respuesta->consumidas as $key => $row)
                                <tr>
                                    @if($row == 1)
                                        <td>{{ $drogas[$key] }}</td>
                                        <td>{!! Form::select($key,$combo_frecuencia, null, ['class' => 'form-control']) !!}</td>
                                    @endif
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
            {!! Form::submit('Continuar', array('class' => 'btn btn-primary')) !!}
        </div>
    </div>
    {!! Form::close() !!}
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
