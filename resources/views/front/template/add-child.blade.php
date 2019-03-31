
<div class="container1 row" id="child-{{$count}}" >
   <div  class="col-md-6 form-group">
      <label>Name</label>
      <input type="text" name="child_name[{{$count}}]" placeholder="Name *">
   </div>
   <div  class="col-md-6 form-group">
      <label> Age</label>
      <select  name="child_age[{{$count}}]" class="sele">
         <option value="">--Age--</option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
      </select>
   </div>
   <div  class="col-md-6 form-group">
      <label> Gender</label>
      <ul class="list-inline">
         <li><label class="radio">Male
            <input type="radio" name="child_gender[{{$count}}]" value="male" checked="">
            <span class="checkround"></span>
            </label>
         </li>
         <li><label class="radio">Female
            <input type="radio" name="child_gender[{{$count}}]" value="female">
            <span class="checkround"></span>
            </label></a>
         </li>
         <li><label class="radio">Other
            <input type="radio" name="child_gender[{{$count}}]" value="other">
            <span class="checkround"></span>
            </label>
         </li>
         
         <li class="pull-right"><button type="button" data-request="remove" data-target="#child-{{$count}}" data-url="{{url('add-more-child')}}" data-count="1" class="add_form_field btn-style">- Remove</button></li>
      </ul>
   </div>
</div>
