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
    <form method="GET" id="form_rips" action="/detalle/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB">
        <div class="row">
            La sustancia y el riesgo son obligatorios. El resto de filtros son opcionales.
        </div>
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
                        <label>Riesgo</label>
                        {!! Form::select('riesgo',array_add($riesgos,'','--Seleccionar--'), (!empty($_GET["riesgo"])? $_GET["riesgo"] : ''), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sustancia</label>
                        {!! Form::select('sustancia',array_add($drogas,0,'--Seleccionar--'),(!empty($_GET["sustancia"])? $_GET["sustancia"] : 0), ['class' => 'form-control']) !!}
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
                        @foreach($results as $respuesta)
                            @if($respuesta->riesgo[$sustancia] == $riesgo)
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col col-lg-2"></div>
    </div>
</div>
@endsection



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