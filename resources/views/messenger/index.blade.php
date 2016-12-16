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

        <div class="row bg-info content">
            <div class="col-sm-10">
                <a href="{{URL::to('messages/create')}}">+ New Message</a>
            </div>
        </div>
	    <div class="row p-t-xxl bg-info content">

            @if (Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            @if($threads->count() > 0)
                @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div class="media alert {{ $class }}">
                    <h4 class="media-heading"><a href="{{ url('messages/' . $thread->id) }}">{{ $thread->subject }}</a></h4>
                    <p>{{ $thread->latestMessage->body }}</p>
                    <p><small><strong class="label label-info">From :</strong> <span class="label label-success"> {{ $thread->creator()->name }}</span></small></p>
                    <p>
                        <small>
                            <strong class="label label-info">To :</strong> 
                            @foreach($thread->participants as $participant)
                                <!-- Don't show the sender in "To" name -->
                                @if($thread->creator()->id != $participant->user->id)
                                    <span class="label label-success">{{ $participant->user->name }}</span>
                                @endif
                            @endforeach
                        </small>
                    </p>
                </div>
                @endforeach
            @else
                <p>Sorry, no threads.</p>
        @endif

	    </div>
	</div>
</section>

@endsection