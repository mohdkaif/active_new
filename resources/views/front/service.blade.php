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
  <h2>Update Service</h2>
  <form role="service" method="post" action="{{url('provider/update-service')}}" >
    <div class="row">
      

       <div class="form-group col-md-6">
        <label for="pwd">Service:</label>
        <select class="form-control" name="service_id" id="service_id" style="height: 45px;" >
          <option value="">Select Service</option>
            @if(!empty($services))
               @foreach($services as $servic)
                  <option @if($service['service_sub_category_id']==$servic['service_sub_category_id']) selected @endif value="{{$servic['service_sub_category_id']}}">{{$servic['service_sub_category_name']}}</option>
               @endforeach
            @endif
        </select>
      </div>


      
      
    </div>
    
    <button type="button" data-request="ajax-submit" data-target='[role="service"]' class="theme-btn btn-style">Submit</button>
  </form>
</div>
</section>