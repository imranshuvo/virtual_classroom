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
					

					@if(count($courses) > 0)
						@foreach($courses as $course)
							<div class="panel panel-default">
							  <div class="panel-heading">{{ $course->name }}</div>
							  <div class="panel-body">
							      <ul class="list-inline">
							      	<li>Start Date: {{ $course->start_date }}</li>
							      	<li>Allowed Student: {{ $course->max_allowed_student }}</li>
							      	<li>Number of Classes: {{ $course->class_number }}</li>
							      </ul>
							  </div>
							</div>
						@endforeach
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