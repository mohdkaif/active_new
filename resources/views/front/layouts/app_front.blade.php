<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" mozdisallowselectionprint moznomarginboxes>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html;" charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
       
        <title>ACTIVE BACCHA</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/favicon.png" type="image/x-icon">
        <!-- Stylesheets -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">
       
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
    <body > 
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
      <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('assets/script.js')}}"></script>

      <script type="text/javascript">
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
      </script>
      @yield('requirejs')
    </body>
</html>
