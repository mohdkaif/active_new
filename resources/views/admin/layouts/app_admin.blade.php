<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" mozdisallowselectionprint moznomarginboxes>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html;" charset="utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="_token" content="{{ csrf_token() }}">
        <title>ACTIVE BACCHA ADMIN</title>

      <link rel="stylesheet" href="{{url('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{url('assets/admin/dist/css/adminlte.min.css')}}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/iCheck/flat/blue.css')}}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/morris/morris.css')}}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
      <!-- Date Picker -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/datepicker/datepicker3.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/daterangepicker/daterangepicker-bs3.css')}}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{url('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{url('assets/admin/custom.css')}}">
    @yield('css')
    </head>
    <body class="hold-transition sidebar-mini"> 
      <div class="wrapper">
          @yield('content')
      </div>
       <script src="{{url('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{url('assets/admin/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/admin/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/admin/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url('assets/admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('assets/admin/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('assets/admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/admin/dist/js/demo.js')}}"></script>

<script src="{{asset('assets/sweetalert2.min.js') }}"></script>
<script src="{{asset('assets/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/select2.full.min.js')}}"></script>
<script src={{ url("assets/js/jquery.dataTables.min.js") }}></script>
<script src={{ url("assets/js/datatables.bootstrap.min.js") }}></script>
<script src="{{asset('assets/script.js')}}"></script>

      <script type="text/javascript">
      $(function () {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },isLocal: false
          });
        }); 

        // $(window).load(function(){
        //   setTimeout(function(){
        //     $('#cover').fadeOut(500);
        //   },500)
        // });
      </script>
      @yield('requirejs')
      @stack('scripts')
    </body>
</html>
