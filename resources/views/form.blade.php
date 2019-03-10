<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel" style="text-align:center;color:Blue;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has("success_done"))
            <div class="alert alert-primary" role="alert">
                {{ Session::get("success_done") }}
            </div>
        @endif
      </div>
      <div class="modal-body">
       <form method="post" data-toogle="validator">
       	@csrf {{ method_field('POST') }}
         <div class="form-group">
         	<input type="hidden" name="id" id="id">
           <label for="exampleInputEmail1">Name</label>
           <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" autofocus="">
         </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Email </label>
           <input type="email" class="form-control" name="email" id="email" placeholder="Email Address"  autofocus="">
         </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Phone </label>
           <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" autofocus="">
         </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Faculty</label>
           <select class="form-control" name="faculty" id="faculty" >
	           	 <option value="EEE">EEE</option>
	           	 <option value="CSE">CSE</option>
	           	 <option value="Nuclear_Engineering">Nuclear_Engineering</option>
	           	 <option value="BIT">BIT</option>
	           	 <option value="Others">Others</option>
           </select>
         </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="insertbutton"></button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--SIngle data show are here-->
<div class="modal fade" id="single-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel" text-align="center"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 
      </div>
      <div class="modal-body">
      <ul class="list-group">
        <li class="list-group-item">ID: <span class="text-danger" id="facultyid"></span></li>
        <li class="list-group-item">Name: <span class="text-danger" id="fullname"></span> </li>
        <li class="list-group-item">Email: <span class="text-danger" id="facultyemail"></span></li>
        <li class="list-group-item">Phone: <span class="text-danger" id="facultynumber"></span></li>
        <li class="list-group-item">Faculty: <span class="text-danger" id="dfaculty"></span></li>
		</ul>
    </div>
  </div>
</div>