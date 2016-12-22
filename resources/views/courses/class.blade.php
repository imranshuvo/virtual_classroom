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
                    <!-- @if(Auth::user()->role_id == 1)
                        <a href="{{ url('student/course') }}/{{ $course->id }}/exams/open" class="list-group-item">Open Exams</a>
                    @else
                        <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all" class="list-group-item">All exam topic</a>
                        <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="list-group-item">+ Create an exam topic</a>
                    @endif -->
                    @if(Auth::user()->role_id == 2)
                        <a href="{{ url('teacher/my-course') }}/{{ $course->id }}" class="list-group-item"><< Back to Course</a>
                    @else
                       <a href="{{ url('student/my-course') }}/{{ $course->id }}" class="list-group-item"><< Back to Course</a>
                    @endif
                </div>
            </div>

            <div class="col-md-9">
                <!-- Main content -->
                <div class="col-md-12">

                    <div class="chat-box col-md-12">
                        <div class="row">
                            <div id="vid-thumb"></div>
                            <div id="vid-box" class="video2"></div>
                        </div>
                        
                
                

                        <div class="class-elements">
                            <div class="row">
                                <form class="form-horizontal" name="loginForm" id="login" action="#" onsubmit="return errWrap(login,this);">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="username" id="username" placeholder="Enter A Username" class="form-control input-sm bg-white" value="{{ Auth::user()->name }}_{{ $course->id }}" disabled="disabled">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm bg-dark" type="submit" name="login_submit" value="Log In">
                                                    <i class="cbutton__icon fa fa-fw fa fa-sign-in"></i>
                                                </button> 
                                            </span>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            
                            
                            
                            <div class="row">
                                <form name="callForm" class="form-horizontal" id="call" action="#" onsubmit="return errWrap(makeCall,this);">


                                 <div class="form-group">
                                        <div class="input-group">
                                            <input type="text"  name="number" id="call" placeholder="Enter User To Call!" class="form-control input-sm bg-white">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm bg-dark" type="submit" name="login_submit" value="Call" data-modal="modal-13">
                                                <i class="cbutton__icon fa fa-fw fa fa fa-phone-square"></i>
                                                </button> 
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="row">
                                <div id="inCall" class="ptext">
                                    @if(Auth::user()->role_id == 2)
                                    <button id="end" class="btn btn-submit bg-dark" onclick="end()" >End Class</button> 
                                    <button id="mute" class="btn btn-submit bg-dark" onclick="mute()">Mute Sound</button>
                                    <button id="pause" class="btn btn-submit bg-dark" onclick="pause()">Pause Class</button>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div id="logs" class="ptext"></div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>
    </div>
</section>

@endsection