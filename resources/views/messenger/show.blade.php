@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l"></h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl bg-info content">


	    	 <h1>{{ $thread->subject }}</h1>
	    	 @foreach($thread->messages as $message)
	            <div class="media">
	                <a class="pull-left" href="#">
	                    <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}" class="img-circle">
	                </a>
	                <div class="media-body">
	                    <h5 class="media-heading">{{ $message->user->name }}</h5>
	                    <p>{{ $message->body }}</p>
	                    <div class="text-muted"><small>Posted {{ $message->created_at->diffForHumans() }}</small></div>
	                </div>
	            </div>
			@endforeach

			<h2>Add a new message</h2>
			<form class="form-horizontal" method="post" action="{{ url('messages') }}/{{ $thread->id }}">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<textarea class="form-control" name="message" required=""></textarea>
					</div>
				</div>

				<!-- 
				<div class="form-group">
					@if(count($users) > 0)
				        <div class="checkbox">
				            @foreach($users as $user)
				                <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->user_id }}">{{ $user->name }}</label>
				            @endforeach
				        </div>
					@endif
				</div>

				-->

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>

			</form>
	    </div>
	</div>
</section>

@endsection