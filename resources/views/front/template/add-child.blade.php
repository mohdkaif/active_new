
<div class="container1 row">
   <div  class="col-md-6 form-group">
      <label>Name</label>
      <input type="text" name="child_name[]" placeholder="Name *">
   </div>
   <div  class="col-md-6 form-group">
      <label> Age</label>
      <select  name="child_age[]" class="sele">
         <option value="">--Age--</option>
         <option value="1">1</option>
         <option value="2">2</option>
      </select>
   </div>
   <div class="clearfix"></div>
   <div  class="col-md-6 form-group">
      <label> Gender</label>
      <ul class="list-inline">
         <li><label class="radio">Male
            <input type="radio" name="child_gender[]" value="male" checked="">
            <span class="checkround"></span>
            </label>
         </li>
         <li><label class="radio">Female
            <input type="radio" name="child_gender[]" value="female">
            <span class="checkround"></span>
            </label></a>
         </li>
         <li><label class="radio">Other
            <input type="radio" name="child_gender[]" value="other">
            <span class="checkround"></span>
            </label>
         </li>
         
         <li class="pull-right"><button type="button" data-request="remove" data-target="#child-more" data-url="{{url('add-more-child')}}" data-count="1" class="add_form_field btn-style">- Remove</li>
      </ul>
      <div>
      </div>
   </div>
</div>