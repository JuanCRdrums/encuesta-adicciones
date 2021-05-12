<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Encuesta de adicciones  </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <!-- styles -->
        {!! Html::style('plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('plugins/adminlte/css/AdminLTE.min.css') !!}
        {!! Html::style('plugins/adminlte/css/skin-purple-light.css') !!}
        {!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('plugins/switchery/switchery.css') !!}
        {!! Html::style('css/template/core.css') !!}
        {!! Html::style('plugins/alertify/themes/alertify.css') !!}
        {!! Html::style('plugins/alertify/themes/alertify.bootstrap.css') !!}
        {!! Html::style('plugins/ionicons/css/ionicons.min.css') !!}
        {!! Html::style('plugins/jQueryUI/jquery-ui.css') !!}
        {!! Html::style('plugins/select2/css/select2.css') !!}
        {!! Html::style('https://fonts.googleapis.com/css?family=Josefin+Sans') !!}
        {!! Html::style('https://fonts.googleapis.com/css?family=Ubuntu') !!}
        {!! Html::style('plugins/summernote/summernote.css') !!}
        {!! Html::script('plugins/jquery/jQuery-2.1.4.min.js') !!}
        {!! Html::style('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}

        <script type="text/javascript">
            /**
             * VARIABLES GLOBALES Y CONSTANTES PARA JAVASCRIPT
             */
            const BASEURL = "{{ URL::to('/') }}";
            const SUBDOMAIN = "encuesta-adicciones";
            var ui_btn_cancel="Cancelar";
            var ui_btn_accept="Aceptar";
        </script>


        @yield('head')


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            {!! Html::style('plugins/html5shiv/html5shiv.min.js') !!}
            <script src="plugins/html5shiv/respond.min.js"></script>
        <![endif]--> 
    </head>
    <body>

        @yield('layout')
        <!-- jquery  -->

        {!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
        {!! Html::script('plugins/switchery/switchery.js') !!}
        {!! Html::script('plugins/jquery.form/jquery.form.js') !!}
        {!! Html::script('plugins/select2/js/select2.min.js') !!}
        {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
        {!! Html::script('plugins/select2/js/i18n/es.js') !!}
        {!! Html::script('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') !!}
        {!! Html::script('plugins/chartinator/chartinator.min.js') !!}
        <!-- Librerias adicionales   -->
        @yield('footer')
        {!! Html::script('plugins/adminlte/js/app.js') !!}
        {!! Html::script('js/template/charts.js') !!}
        {!! Html::script('js/template/webcomp.js?v='.date('YmdHis')) !!}
        {!! Html::script('js/template/core.js?v='.date('YmdHis')) !!}
 
        <div id="loading-ajax"><span id="loader"></span></div>
        <script>
            function onReady(callback) {
              var intervalId = window.setInterval(function() {
                if (document.getElementsByTagName('body')[0] !== undefined) {
                  window.clearInterval(intervalId);
                  callback.call(this);
                }
              }, 500);
            }

            function setVisible(selector, visible) {
              document.querySelector(selector).style.display = visible ? 'block' : 'none';
            }

            onReady(function() {
              setVisible('#main-wrapper', true);
              setVisible('#loading-ajax', false);
            });
        </script>
    </body>
</html>