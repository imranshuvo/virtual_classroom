@extends('layouts.app')


@section('content')


<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">All Courses</h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
			

			@if(count($courses) > 0)
				@foreach($courses as $course)

					<div class="col-md-3 single-course-box">

						@if(isset($type))
							@if($type == 'student')
								<a href="{{ url('student/my-course/') }}/{{ $course->id }}">
							@else
								<a href="{{ url('teacher/my-course/') }}/{{ $course->id }}">
							@endif
						@else 
							<a href="{{ url('course') }}/{{ $course->id }}" >
					  	@endif
						
							<div class="item text-center bg-info" style="height: 315px;">
								<div class="top w-full p-h-xxl p-v-lg">
									<h5>{{ $course->title }}</h5>
									<div class="line line-lg b-b b-white w-3x m-auto"></div>
								</div>	
								<div class="bottom w-full p-h-xxl p-v-lg">
									<p class="h6"><b>Author:</b> <a href="{{ url('user/teacher/') }}{{ $course->user_id }}">{{ $course->name }}</a></p>
									<h6>Start Date: {{ date('j F,Y',strtotime($course->start_date)) }}</h6>
									<h6>Allowed Students: {{ $course->max_allowed_student }}</h6>
									<h6>Number of Classes: {{ $course->class_number }}</h6>								
								</div>						
							</div>
						</a>
					</div>
				@endforeach
			@else

				<div class="media-body">
			    	<div class="pos-rlt wrapper b b-light r r-2x bg-danger">
	                	<span class="arrow left pull-up arrow-danger"></span>
	                	<p class="m-b-none">Sorry, no courses found ! Please try again!</p>
	              	</div>
			  	</div>

			@endif
	    </div>
	</div>
</section>




@endsection