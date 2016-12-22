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
                    <a href="{{ url('course')}}/{{ $course->id }}/class" class="list-group-item">Class</a>
                    <a href="{{ url('student/course') }}/{{ $course->id }}/exams/open" class="list-group-item">Open Exams</a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Main content -->
                <div class="col-md-12">

                    <div class="chat-box col-md-12">
                        <div id="vid-thumb"></div>
                        <div id="vid-box" class="video2"></div>
                
                

                        <div class="test">

                            <form name="loginForm" id="login" action="#" onsubmit="return errWrap(login,this);">

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="username" id="username" placeholder="Enter A Username" class="form-control input-sm bg-white">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm bg-dark" type="submit" name="login_submit" value="Log In">
                                                <i class="cbutton__icon fa fa-fw fa fa-sign-in"></i>
                                            </button> 
                                        </span>
                                    </div>
                                </div>

                            </form>
                            
                            
                            
                            <form name="callForm" id="call" action="#" onsubmit="return errWrap(makeCall,this);">


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
                            
                            <div id="inCall" class="ptext">
                                <button id="end" class="btn btn-submit bg-dark" onclick="end()" >End</button> 
                                <button id="mute" class="btn btn-submit bg-dark" onclick="mute()">Mute</button> 
                                <button id="pause" class="btn btn-submit bg-dark" onclick="pause()">Pause</button>
                            </div>
                            
                            <div id="logs" class="ptext"></div>




                        </div>
                    </div>
                    
                </div>

            </div>

        </div>
    </div>
</section>

@endsection