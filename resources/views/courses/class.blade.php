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
	    <div class="row p-t-xxl">

            <div id="vid-box"></div>
            <div id="vid-thumb"></div>

            <form name="loginForm" id="login" action="#" onsubmit="return login(this);">
                <input type="text" name="username" id="username" placeholder="Pick a username!" />
                <input type="submit" name="login_submit" value="Log In">
            </form>


            <form name="callForm" id="call" action="#" onsubmit="return makeCall(this);">
                <input type="text" name="number" placeholder="Enter user to dial!" />
                <input type="submit" value="Call"/>
            </form>

            <div id="inCall"> <!-- Buttons for in call features -->
                <button id="end" onclick="end()">End</button> <button id="mute" onclick="mute()">Mute</button> <button id="pause" onclick="pause()">Pause</button>
            </div>

	    </div>
	</div>
</section>

@endsection