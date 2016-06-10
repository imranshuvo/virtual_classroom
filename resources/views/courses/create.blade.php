@extends('layouts.app')


<?php 

$file_path = base_path()."/public/includes/data.inc";
include($file_path); 
?>

@section('content')
	

	<div class="row" style="margin-top: 60px;">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create Course!</div>

				<div class="panel-body" style="margin-top: 50px;">
					<div class="create-course">
						<form class="form-horizontal" role="form" action="{{ url('register/course') }}" method="post">
						    {{ csrf_field() }}
						    <div class="form-group">
						      <label class="control-label col-sm-2" for="email">Name</label>
						      <div class="col-sm-10">
						        <input type="text" class="form-control" id="email" name="name" placeholder="Enter name of the course">
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="control-label col-sm-2" for="email">Category</label>
						      <div class="col-sm-10">
						         <select name="category_id" id="" class="form-control">
						         	@foreach($category as $key => $value)
						         	    <option value="{{ $key }}">{{ $value }}</option>
						         	 @endforeach
						         </select>
						      </div>
						    </div>

						    <div class="form-group">
						    	<label for="class_number" class="col-sm-2 control-label">Number of Classes</label>
						    	<div class="col-sm-10">
						    		<input type="number" name="class_number" class="form-control">
						    	</div>
						    </div>
						    <div class="form-group">
						    	<label for="class_number" class="col-sm-2 control-label">Maximum Allowed Students ( max 20 )</label>
						    	<div class="col-sm-10">
						    		<input type="number" name="max_allowed_student" class="form-control" min="1" max="20">
						    	</div>
						    </div>
						    <div class="form-group">
						    	<label for="class_number" class="col-sm-2 control-label">Start Date</label>
						    	<div class="col-sm-10 input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy" id="dp3">
						    		<input type="text" name="start_date" class="form-control" id="dp5">
						    		  <span class="add-on"><i class="icon-th"></i></span>
						    	</div>
						    </div>

						    <div class="form-group">
						    	<label for="class_number" class="col-sm-2 control-label">Description</label>
						    	<div class="col-sm-10">
						    		<textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
						    	</div>
						    </div>
						    
						    <div class="form-group">        
						      <div class="col-sm-offset-2 col-sm-10">
						        <button type="submit" class="btn btn-default">Submit</button>
						      </div>
						    </div>
						  </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	


@endsection