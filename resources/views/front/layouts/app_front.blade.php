<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" mozdisallowselectionprint moznomarginboxes>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html;" charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="_token" content="{{ csrf_token() }}">
       
        <title>ACTIVE BACCHA</title>
        <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Stylesheets -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
         <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{url('assets/select2.min.css')}}">
        <!-- Responsive -->
        <style>
          .contact-form .form-group {
            position: relative;
            margin-bottom: 12px;
          }
        </style>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css') }}" rel="stylesheet">
 
    @yield('css')
    </head>
    <body> 
      <div id="cover"></div>
      <div class="page-wrapper">
         <div id="wrapper">
          @yield('content')
        </div>
      </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
       {{-- active --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{url('assets/js/jquery.fancybox.js')}}"></script>
        <script src="{{url('assets/js/appear.js')}}"></script>
        <script src="{{url('assets/js/mixitup.js')}}"></script>
        <script src="{{url('assets/js/owl.js')}}"></script>
        <script src="{{url('assets/js/wow.js')}}"></script>
        <script src="{{url('assets/js/script.js')}}"></script>

        <script type="text/javascript">

        $('.burger, .overlay').click(function(){
          $('.burger').toggleClass('clicked');
          $('.overlay').toggleClass('show');
          $('nav').toggleClass('show');
          $('body').toggleClass('overflow');
        });



        </script>
         {{-- end active --}}
      <script src="{{asset('assets/sweetalert2.min.js') }}"></script>
      <script src="{{asset('assets/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
      <script src="{{asset('assets/select2.full.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

      <script src="{{asset('assets/script.js')}}"></script>

      <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var token    = $('meta[name="csrf-token"]').attr('content');
        
      $(function () {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },isLocal: false
          });
        }); 

        $(window).load(function(){
          setTimeout(function(){
            $('#cover').fadeOut(500);
          },500)
        });

        $('.date').datepicker({  

          format: 'yyyy-mm-dd'

         });
               
      
      </script>
      @yield('requirejs')
    </body>
</html>
