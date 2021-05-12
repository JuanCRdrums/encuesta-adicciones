@extends('template.layout')

@section('head')
@parent
{!! Html::style('plugins/datatables/datatables.min.css') !!}
{!! Html::style('plugins/datatables/Buttons/css/buttons.dataTables.min.css') !!}
@stop


@section('content')
{!! Form::open(array('url' => '/store-1')) !!}
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
                <p></p>
                <p>
                    Gracias por aceptar esta breve entrevista sobre alcohol, 
                    tabaco y otras drogas. A continuación encontrará algunas preguntas sobre 
                    su experiencia de consumo de sustancias a lo largo de su vida, 
                    así como en los últimos tres meses.  Estas sustancias pueden ser fumadas, 
                    ingeridas, aspiradas, inhaladas, inyectadas o tomadas en forma de 
                    pastillas o píldoras.						
                </p>
                <p>
                    Algunas de las sustancias incluidas pueden haber sido recetadas por 
                    un médico (p.ej. pastillas adelgazantes, tranquilizantes, o determinados 
                    medicamentos para el dolor).  Para esta entrevista, <strong>no</strong> vamos 
                    a anotar medicinas que hayan sido consumidas tal como han sido prescritas por 
                    su médico. Sin embargo, si ha tomado alguno de estos medicamentos por motivos 
                    distintos a los que fueron prescritos o los toma más frecuentemente o en dosis 
                    más altas a las prescritas, por favor regístrelo. Si bien estamos interesados en 
                    conocer su consumo de diversas drogas, tenga la plena seguridad que esta 
                    información será tratada con absoluta confidencialidad.
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h4>Pregunta 1</h4>
                <p>
                    A lo largo de su vida, ¿cuál/es de las siguientes sustancias ha consumido 
                    <strong>alguna vez</strong>? (SOLO PARA USOS NO-MÉDICOS)				
                </p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($drogas as $key => $row)
                                <tr>
                                    <td>
                                        <input class="js-switch" name="{{$key}}" type="checkbox" >
                                    </td>
                                    <td>{{ $row }}</td>
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
