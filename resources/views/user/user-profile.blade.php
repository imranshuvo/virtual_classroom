@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Profile</h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
            <div class="col-md-12"> 
              @if (session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                  <!-- User image goes here -->
                  <div class="col-md-12"><a href="" title="Change photo" class="btn btn-lg" data-toggle="modal" data-target="#editPhoto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>

                  <div class="col-md-12 user-image-frame">
                      <?php  ?>
                      <img src="{{ url($user->profile_photo) }}">
                  </div>

                  <!-- User Image upload modal goes here -->

                  <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Upload/Edit your profile photo</h4>
                        </div>
                          <div class="modal-body">
                             <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('user/profile/upload-photo') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="file" name="profile-photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>                  
              </div>


              <div class="col-md-8">
                  <div class="row">
                      <div class="col-md-12">
                            <!-- User bio goes here -->
                            <h3 class="user-name">{{ $user->name }} <span class="edit-name text-right"><a href="" title="Change name" class="btn btn-lg" data-toggle="modal" data-target="#editName"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span></h3>
                            <h6 class="user-email">{{ $user->email }}</h6>
                            @if($user->role_id == 2)
                              <h5 class="user-designation label label-info">Teacher</h5> 
                            @else
                              <h5 class="user-designation label label-info">Student</h5>
                            @endif


                            <!-- edit Teacher/Student name -->
                            <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Edit your name</h4>
                                    </div>
                                      <div class="modal-body">
                                         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('user/profile/edit-name') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                      </div>
                        
                  </div>
                  

                  <div class="my-courses row" style="margin-top: 40px;">

                      <div class="col-md-12">
                        @if(count($t_courses) > 0)
                            <div class="panel panel-success" >
                                <div class="panel panel-primary">
                                  <div class="panel-heading">My Courses</div>
                                  <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($t_courses as $course)
                                                <li class="list-group-item list-group-item-success"><a href="{{ url('teacher/my-course') }}/{{ $course->course_id }}">{{ $course->title }}</a></li>
                                            @endforeach
                                        </ul>
                                  </div>

                              </div>
                            </div>

                        @endif

                        @if(count($s_courses))
                            <div class="panel panel-primary">
                                <div class="panel-heading">My Courses</div>
                                <div class="panel-body">
                                      <ul class="list-group">
                                          @foreach($s_courses as $course)
                                              <li class="list-group-item list-group-item-success"><a href="{{ url('student/my-course') }}/{{ $course->course_id }}">{{ $course->title }}</a></li>
                                          @endforeach
                                      </ul>
                                </div>
                            </div>

                        @endif
                        </div>
                  </div>
              </div>
            </div>

        </div>
    </div>
</section>

@endsection