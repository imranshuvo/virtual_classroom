@extends('layouts.app')


@section('content')


<?php
    $image = basename($course->large_url);
?>


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
            <div class="course-image-single">
                <div class="row">
                    <div class="image col-md-12">
                        @if(!empty($image))
                        <img src="{{ asset('course/imgs') }}/<?php echo $image ?>" class="item img-bg img-info">
                        @else
                            <img src="{{ asset('course/imgs/no') }}/placeholder.png" class="item img-bg img-info">
                        @endif
                    </div>
                </div>
            </div>

            <div class="after-image">
                <div class="row">

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
                    <div class="col-md-9">
                        <div class="row">
                            <h2 class="content-title">About This Course</h2>
                            <p class="published-at">Published : {{ date('j F,Y',strtotime($course->created_at )) }}</p>
                            <h4 class="course-title content-title" >Course Description</h4>
                            <p class="course-description">
                                {!! $course->description !!}
                            </p>
                        </div>
                        <div class="row" style="margin-top: 100px;">
                            <h2 class="content-title" style="margin-bottom: 30px;">Instructor Biography</h2>
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <!-- Instructor photo -->
                                    @if(!empty($user->profile_photo))
                                        <img src="{{ url($user->profile_photo) }}" class="img-small">
                                    @else
                                        <img src="{{ url('user/no_photo/no_photo.png') }}" class="img-small">
                                    @endif
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <h4 class="user-name">{{ $user->name }}</h4>
                                        <p class="user-designation">{{ $user->designation }}</p>
                                        <p class="user-biography">{{ $user->biography }}</p>
                                    </div>
                                    <div class="row">
                                        <h4 class="other-courses-by-me" style="margin-top: 50px;">More Courses by Me</h4>
                                        @if(count($courses) > 0)
                                            @foreach($courses as $course)
                                                <a href="{{ url('course') }}/{{ $course->id }}">{{ $course->title }}</a>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    {{$errors->first()}}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if(isset($message))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                            @endif

                        </div>
                        <div class="row">
                            <div id="inCall" class="ptext pull-right">
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#editCourse"><i class="fa fa-edit"></i> Edit</a> 
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteCourse"><i class="fa fa-remove"></i> Delete</a>
                            </div>
                        </div>
                    </div>



                    <!-- Modals -->
                    <div class="row">
                        <!-- Edit Course Modal -->
                        <div id="editCourse" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit course</h4>
                                  </div>
                                  <div class="modal-body">
                                        <form class="form-horizontal" role="form" action="{{ url('course') }}/{{ $course->id }}/update" method="post" enctype="Multipart/form-data">
                                        {{ csrf_field() }}
                                            
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Number of Classes</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="class_number" class="form-control" value="{{ $course->class_number }}" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Maximum Allowed Students ( max 20 )</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="max_allowed_student" value="{{ $course->max_allowed_student }}" class="form-control" min="1" max="20" required="">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea name="description" class="form-control" id="summernote" cols="30" rows="10" required="">{!! $course->description !!}</textarea>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">        
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                              </div>
                        </div>

                        <!-- Delete Course modal -->
                        <div id="deleteCourse" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete course</h4>
                                  </div>
                                  <div class="modal-body">
                                      <p>Are you sure you want to delete this course ? This can't be reverted!</p>
                                  </div>
                                  <div class="modal-footer">
                                        <form class="form-vertical" method="post" action="{{ url('course') }}/{{ $course->id }}/delete">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <button type="submit" href="{{ url('course') }}/{{ $course->id }}/delete" class="btn btn-danger">Confirm</button>
                                            </div>
                                        </form>
                                       
                                       <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    	    </div>
        </div>
	</div>
</section>

@endsection