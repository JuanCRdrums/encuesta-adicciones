@extends('template.layout')

@section('head')
@parent
{!! Html::style('plugins/datatables/datatables.min.css') !!}
{!! Html::style('plugins/datatables/Buttons/css/buttons.dataTables.min.css') !!}
@stop


@section('content')
{!! Form::open(array('url' => '/final-store/' . $respuesta->id)) !!}
	<div class="container">
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h2>OMS - ASSIST V3.0</h2>
                <p>Todos los campos son requeridos</p>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col col-lg-3"></div>
            <div class="col-md-auto">
                <h4>Datos del consultante</h4>
                <div class="well well-sm">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Número de documento </label>
                          {!! Form::text('documento',null,['class'=>'form-control','required']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nombre completo </label>
                          {!! Form::text('nombre',null,['class'=>'form-control','required']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Ciudad </label>
                          {!! Form::text('ciudad',null,['class'=>'form-control','required']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Teléfono </label>
                          {!! Form::text('telefono',null,['class'=>'form-control','required']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Correo electrónico   </label>
                          {!! Form::text('email',null,['class'=>'form-control']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Empresa   </label>
                          {!! Form::text('empresa',null,['class'=>'form-control']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Cargo   </label>
                          {!! Form::text('cargo',null,['class'=>'form-control']) !!}
                        </div>
                      </div>
                      
                    </div>
                </div>
            </div>
            <div class="col col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-auto">
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
