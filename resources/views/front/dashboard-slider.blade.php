  <section class="info-section no-pd-top Modal" >
               <div class="auto-container">
                  <div class="row clearfix">
                     <!-- Info Block -->
                     <div class="owl-carousel1">
                   
                      <div class="info-block ">
                      <a href="{{url('provider/profile')}}" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix ">
                           <div class="icon-box"><i class="fa fa-user"></i></div>
                           <h3>My Profile</h3>
                        </div></a>
                     </div>
                    
                     
                    
                    @if(!empty(\Auth::user()) && \Auth::user()->user_type=='provider')
                     <div class="info-block ">
                     <a href="#" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                            <div class="icon-box"><i class="fa fa-rupee"></i></div>
                           <h3>My Earning</h3>
                        </div></a>
                     </div>
                    
                     
                  
                      <div class="info-block ">
                     <a href="{{url('provider/service')}}" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                            <div class="icon-box"><i class="fa fa-comments"></i></div>
                           <h3>Manage Service</h3>
                        </div></a>
                     </div>
                    @endif
                     
                    
                    {{--  <div class="info-block ">
                     <a href="manage-service.php" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                           <div class="icon-box"><i class="fa fa-history"></i></div>
                           <h3>Manage service</h3>
                        </div></a>
                     </div> --}}
                   
                     
                    
                      <div class="info-block ">
                     <a href="bank-details.php" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                           <div class="icon-box"><i class="fa fa-university"></i></div>
                            <h3>My Booking</h3>
                        </div>
                        </a>
                     </div>
                    
                     
                     
                {{--      
                      
                     <div class="info-block ">
                     <a href="upload_document.php" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                           <div class="icon-box"><i class="fa fa-upload"></i></div>
                           <h3>Upload document</h3>
                        </div></a>
                     </div>
                   
                    
                     
                      <div class="info-block ">
                      <a href="change-payent-details.php" style="text-align:center">
                        <div class="inner-box inner-box1 clearfix">
                           <div class="icon-box"><i class="fa fa-user-circle-o"></i></div>
                           <h3>Extra</h3>
                        </div></a>
                     </div>
                    --}}
                     
                     </div>
                  </div>
               </div>
            </section>