
           <section class="page-title" style="background-image:url({{url('assets/images/main-slider/eight-1.jpg')}});">
         
            <div class="auto-container">
               
               <h1 class="text-sky">Service Details</h1>
               
            </div>
         </section>
           <section class="intro-section" style="margin-top: 37px;">
        <div class="auto-container">
            <div class="row clearfix">
                 <div class="image-column col-md-5 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        @if(!empty($service_details['photo']))
                            <img src="{{url('assets/service/images/'.$service_details['photo'])}}" alt="" />
                        @else
                            <img src="{{url('assets/images/about_left.jpg')}}">
                        @endif
                        
                    </div>
                </div>
                <div class="text-column col-md-7 col-sm-12 col-xs-12">
                    <div class="inner-column">
                       
                        <div class="sec-title">
                            <h2>{{$service_details['name']}}</h2>
                        </div>
                        <p>{{!empty($service_details['description'])?$service_details['description']:''}}</p>
                        <p>{{$service_details['service_category']['service_category_name']}}-{{!empty($service_details['service_sub_category']['service_sub_category_name'])?$service_details['service_sub_category']['service_sub_category_name']:''}}</p>
                        SERVICE DAYS:
                  <ul class="about-ul">
                    @if(!empty($service_details['service_days']))
                        @foreach($service_details['service_days'] as $k => $v)
                        <li>
                            <span class="about-li" ><i class="fa fa-hand-o-right"></i></span>
                            @if($v['day']==1)'Sunday :'@elseif($v['day']==2)'Monday :'@elseif($v['day']==3)'Tuesday :'@elseif($v['day']==4)'Wednesday :'@elseif($v['day']==5)'Thursday :'@elseif($v['day']==6)'Friday :'@elseif($v['day']==7)'Saturday :'@endif
                            
                            {{date('g:i A',strtotime($v['start_time']))}}-{{date('g:i A',strtotime($v['end_time']))}}
                        </li>
                        @endforeach
                    @endif

                    
                   
                  </ul>
                    </div>
         
                   
                </div>

                 
            </div>
        </div>
    </section>
 {{--  <section class="learning-skills">
        <div class="auto-container">
            <div class="sec-title text-center">
               
                <h2><span>Learning </span> Skills</h2>
             
            </div>

            <div class="row clearfix">
                <div class="left-column col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-column">
                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-1.png')}}" alt="" class="icon">
                                <h4><a href="#">Responsibility</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>

                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-2.png')}}" alt="" class="icon">
                                <h4><a href="#">Teamwork</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>

                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-3.png')}}" alt="" class="icon">
                                <h4><a href="#">Communication</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="right-column pull-right col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-column">
                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-4.png')}}" alt="" class="icon">
                                <h4><a href="#">Independence</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>

                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-5.png')}}" alt="" class="icon">
                                <h4><a href="#">Motivation</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>

                        <div class="skill-block">
                            <div class="inner">
                                <img src="{{url('assets/images/resource/skill-6.png')}}" alt="" class="icon">
                                <h4><a href="#">Enquiring Mind</a></h4>
                                <p>Dolor amet consectetur elit eiusmod tempor enim veniam tempore quis sed ipsum.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="center-image col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-box">
                        <figure class="image"><img src="{{url('assets/images/resource/image-3.jpg')}}" alt=""></figure>
                    </div>
                </div>

            </div>
        </div>
    </section>  --}}
      