@extends('layouts.app')


@section('content')


<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">{{ $course->title }}</h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl bg-info content">

            <div class="col-md-3">
                <!-- left sidebar -->
                <div class="list-group">
                    <a href="{{ url('course') }}/{{ $course->id }}/class" class="list-group-item">Class</a>
                    <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all" class="list-group-item">All exam topic</a>
                    <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="list-group-item">+ Create an exam topic</a>

                </div>
            </div>

            <div class="col-md-9">
                <!-- Main content -->
                <div class="col-md-12">
                    <div class="row">
                        <div id="inCall" class="ptext pull-right">
                              <a href="{{  }}" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a> 
                              <a href="{{  }}" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
                        </div>
                        
                    </div>
                    
                </div>

            </div>

	    </div>
	</div>
</section>

@endsection