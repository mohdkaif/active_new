@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/signup.css')}}">
@endsection
<section class="page-title" style="background-image:url(assets/images/main-slider/eight-1.jpg);">
    <div class="auto-container">
        <h1 class="text-sky">Manage Service</h1>
    </div>
</section>
<section >
<div class="container">
  {{-- <h2>Services</h2> --}}
 <div class="content-side col-md-12 col-sm-12 col-xs-12">
                 
                     <div class="row-pan">
                        <h2>Bookings</h2>
                        <div class="mixedSlider">
                           <div class="MS-controls">
                              <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                              <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                           </div>
                           <div class="MS-content">
                            @if(!empty($bookings))
                            @foreach($bookings as $key => $value)
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i>{{$value['price']}}</h3>
                                          </div>
                                          <div class="col-md-8">
                                             {{-- <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div> --}}
                                             {{$value['user_details']['first_name']}} {{$value['user_details']['last_name']}}
                                          </div>
                                       </div>
                                    </div>
                                    @if(!empty($value['user_details']['image']))
                                      <img src="{{url('assets/users/images/'.$value['user_details']['image'])}}" alt="" />
                                    @else
                                      <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    @endif
                                    
                                 </div>
                                 <div class="col-md-12">
                                  <p>{{$value['service_category']['service_category_name']}}-{{!empty($value['service_sub_category']['service_sub_category_name'])?$value['service_sub_category']['service_sub_category_name']:''}}
                                    {{-- <i class="fa fa-map-marker" aria-hidden="true"></i>  --}}
                                    </p>

                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px">{{!empty($value['description'])?$value['description']:''}}
                                    {{-- @if(!empty($value['service_days']))
                                      @foreach($value['service_days'] as $k => $v)
                                        <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px">@if($v['day']==1)'Sunday:'@elseif($v['day']==2)'Monday:'@elseif($v['day']==3)'Tuesday:'@elseif($v['day']==4)'Wednesday:'@elseif($v['day']==5)'Thursday:'@elseif($v['day']==6)'Friday:'@elseif($v['day']==7)'Saturday:'@endif
                                          {{date('g:i A',strtotime($v['start_time']))}}-{{date('g:i A',strtotime($v['end_time']))}}
                                        </p>
                                      @endforeach
                                    @endif
                                    --}}
                                  </p>
                                    <a href="{{url('provider/service/'.$value['id'])}}" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                              @endforeach
                              @endif
                            {{--   <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div> --}}
                              {{-- <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div> --}}
                              {{-- <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div> --}}
                          {{--     <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div> --}}
                           </div>
                        </div>
                     </div>
                     <hr>
                     {{-- <div class="row-pan">
                        <h2>CHESS</h2>
                        <div class="mixedSlider">
                           <div class="MS-controls">
                              <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                              <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                           </div>
                           <div class="MS-content">
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                              <div class="item">
                                 <div class="imgTitle">
                                    <div  class="blogTitle">
                                       <div class="list-inline" >
                                          <div class="col-md-4">
                                             <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="pull-right">
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                                <i class="fa fa-star" style="color: #00cbc9"></i>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                 </div>
                                 <div class="col-md-12">
                                    <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                    <a href="#" class="theme-btn btn-style-one">Read More</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                     </div> --}}
                     <hr>
                     {{--    <div class="row-pan">
                           <h2>CHESS</h2>
                           <div class="mixedSlider">
                              <div class="MS-controls">
                                 <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                                 <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                              </div>
                              <div class="MS-content">
                                 <div class="item">
                                    <div class="imgTitle">
                                       <div  class="blogTitle">
                                          <div class="list-inline" >
                                             <div class="col-md-4">
                                                <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="pull-right">
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    </div>
                                    <div class="col-md-12">
                                       <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                       <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                       <a href="#" class="theme-btn btn-style-one">Read More</a>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="imgTitle">
                                       <div  class="blogTitle">
                                          <div class="list-inline" >
                                             <div class="col-md-4">
                                                <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="pull-right">
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    </div>
                                    <div class="col-md-12">
                                       <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                       <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                       <a href="#" class="theme-btn btn-style-one">Read More</a>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="imgTitle">
                                       <div  class="blogTitle">
                                          <div class="list-inline" >
                                             <div class="col-md-4">
                                                <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="pull-right">
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    </div>
                                    <div class="col-md-12">
                                       <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                       <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                       <a href="#" class="theme-btn btn-style-one">Read More</a>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="imgTitle">
                                       <div  class="blogTitle">
                                          <div class="list-inline" >
                                             <div class="col-md-4">
                                                <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="pull-right">
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    </div>
                                    <div class="col-md-12">
                                       <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                       <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                       <a href="#" class="theme-btn btn-style-one">Read More</a>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="imgTitle">
                                       <div  class="blogTitle">
                                          <div class="list-inline" >
                                             <div class="col-md-4">
                                                <h3 class="pull-left"><i class=" fa fa-inr"></i> 600</h3>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="pull-right">
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                   <i class="fa fa-star" style="color: #00cbc9"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <img src="{{url('assets/images/12.jpg')}}" alt="" />
                                    </div>
                                    <div class="col-md-12">
                                       <p style="color:#1da7aa;font-size: 12px;font-weight: 700;padding-top:7px"><i class="fa fa-map-marker" aria-hidden="true"></i> C-217, 1st Floor, C Block, Sector 63, Noida,</p>
                                       <p>Lorem ipsum dolor sit amet, consectetur adcing.</p>
                                       <a href="#" class="theme-btn btn-style-one">Read More</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div> --}}
               </div>
 {{--  <form role="service" method="post" action="{{url('provider/update-service')}}" >
    <div class="row">
      

       <div class="form-group col-md-6">
        <label for="pwd">Service:</label>
        <select class="form-control" name="service_id" id="service_id" style="height: 45px;" >
          <option value="">Select Service</option>
            @if(!empty($services))
               @foreach($services as $service)
                  <option @if($service['service_sub_category_id']==$service['service_sub_category_id']) selected @endif value="{{$servic['service_sub_category_id']}}">{{$servic['service_sub_category_name']}}</option>
               @endforeach
            @endif
        </select>
      </div>


      
      
    </div>
    
    <button type="button" data-request="ajax-submit" data-target='[role="service"]' class="theme-btn btn-style">Submit</button>
  </form> --}}
</div>
</section>