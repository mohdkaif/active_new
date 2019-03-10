@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/signup.css')}}">
@endsection
<section class="page-title" style="background-image:url(assets/images/main-slider/eight-1.jpg);">
    <div class="auto-container">
        <h1 class="text-sky">Signup</h1>
    </div>
</section>
<section class="intro-section">
    <div class="container">
        <!--our-quality-shadow-->
        <div class="clearfix"></div>
        <div class="row">
            <div class="intro-text text-center">
                <h2>SIGNUP</h2>  
            </div>
            <div class="contact-formlogin">
                <!--Contact Form-->
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="click">
                            <label class="radio"><p>User</p>
                                <input type="radio" name="one" id="user" data-request="address-form" data-target="#address" data-id="user" data-url="{{url('get-user-form')}}" name="one" checked>
                                <span class="checkround"></span>
                            </label>
                            <label class="radio"><p>Service Provider</p>
                                <input type="radio" name="one"  data-request="address-form" data-target="#address" data-id="provider" data-url="{{url('get-user-form')}}" >
                                <span class="checkround"></span>
                            </label>
                        </div>
                    </div>
                    <!--- user form Design ------------------>
                    <div id="address" class="showhide">
                    </div>
                    <!--- Service provider form Design ------------------>
                    <!-- <div id="div-2" class="showhide">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
    
        
@section('requirejs')
<script src="{{url('assets/js/price_range_script.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap 4 -->
<script src="{{url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/admin/plugins/select2/select2.full.min.js')}}"></script>

<script src="{{url('assets/admin/plugins/select2/select2.full.min.js')}}"></script>


<script type="text/javascript">
    $("document").ready(function() {
        setTimeout(function() {
            $("#user").trigger('click');
        },10);

        
    });
    $(function () {
        $('.select2').select2()
    });

    function get_city(str) {
            var dataString = 'state_id='+str;
            
            $.ajax({
              type:'POST',
              data:dataString,
              url:base_url + '/cities/list',
              success:function(data) {
                console.log(data.html);
                $("#city").html(data.html);
             
              }
            });
        }


        function get_city1(str) {
            var dataString = 'state_id='+str;
            
            $.ajax({
              type:'POST',
              data:dataString,
              url:base_url + '/cities/list',
              success:function(data) {
                console.log(data.html);
                $("#city1").html(data.html);
             
              }
            });
        }

    $('.burger, .overlay').click(function(){
        $('.burger').toggleClass('clicked');
        $('.overlay').toggleClass('show');
        $('nav').toggleClass('show');
        $('body').toggleClass('overflow');
    });

    $('.mixedSlider').multislider({
        duration: 1000,
        interval: 6000,
    });


    $(".messages").animate({ scrollTop: $(document).height() }, "fast");

    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });

    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    $("#status-options ul li").click(function() {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");

        if($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
        } else {
            $("#profile-img").removeClass();
        };

        $("#status-options").removeClass("active");
    });

    function newMessage() {
        message = $(".message-input input").val();
        if($.trim(message) == '') {
            return false;
        }
        $('<li class="sent"><img src="https://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    };

    $('.submit').click(function() {
        newMessage();
    });

    $(window).on('keydown', function(e) {
        if (e.which == 13) {
            newMessage();
            return false;
        }
    });
//# sourceURL=pen.js
</script>
@endsection