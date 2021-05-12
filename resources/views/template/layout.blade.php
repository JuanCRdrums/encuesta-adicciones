@extends('template.index')

@section('layout')
<!-- Site wrapper -->
<div id="main-wrapper" class="wrapper">


        @yield('content')




    @section('footer')
    {!! Html::script('plugins/alertify/alertify.min.js') !!}
    {!! Html::script('plugins/chartjs/dist/Chart.min.js') !!}
    {!! Html::script('plugins/chartjs/dist/chartjs-plugin-annotation.min.js') !!}
    {!! Html::script('plugins/jQueryUI/jquery-ui.min.js') !!}
    {!! Html::script('plugins/summernote/summernote.min.js') !!}
    {!! Html::script('plugins/summernote/lang/summernote-es-ES.js') !!}
    <!-- /.layout footer -->
    @stop


    @include('template.footer')





@stop