@extends('layouts.app')


@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All of my courses</div>

                <div class="panel-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if($errors->any())
                    	<div class="alert alert-danger">
							<h4>{{$errors->first()}}</h4>
                    	</div>
					@endif
										

					@if(count($course) > 0)
						<div class="panel panel-default">
						  <div class="panel-heading">{{ $course->name }}</div>
						  <div class="panel-body">
						      <ul class="list-inline">
						      	<li>Start Date: {{ $course->start_date }}</li>
						      	<li>Allowed Student: {{ $course->max_allowed_student }}</li>
						      	<li>Number of Classes: {{ $course->class_number }}</li>
						      </ul>
							@if(Auth::check())
								@if(Auth::user()->role_id == 1)
							    <div class="col-md-4 col-md-offset-4">
							      	 <form action="{{ url('course') }}/{{ $course->id }}/enroll" method="get">
										<div class="form-group">
											<button type="submit" class="form-control btn btn-primary" value="Enroll">Enroll</button>
										</div>
							      	</form>
							    </div>
							    @endif
							@else
								<div class="alert alert-notice">
									You must <a href="{{ url('login') }}">login</a> to enroll in this course!
								</div>
						    @endif

						  
						  </div>
						</div>

					@else
						<div class="alert alert-error">
							No Courses Found!
						</div>
					@endif


                </div>
            </div>
        </div>
    </div>
</div>



@endsection