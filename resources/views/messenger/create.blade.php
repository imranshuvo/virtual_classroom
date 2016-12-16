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
            @if($hide == 0)
            <div class="send-message-form">
                <form action="{{ url('messages') }}" method="post"  class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="subject">Subject</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="" required="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="message">Message</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="message" name="message" required=""></textarea>
                      </div>
                    </div>
                    <!-- Bring the use of the associated course . Needs update -->
                       @if(count($users) > 0)
                         <div class="form-group">
                            <div class="checkbox">
                                @foreach($users as $user)
                                    @if(Auth::user()->id != $user->id)
                                    <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">
                                        <span class="thumb-sm avatar m-t-n-sm m-b-n-sm m-l-sm"> 
                                          @if(!empty($user->profile_photo))
                                              <img src="{{ url($user->profile_photo) }}">
                                          @else
                                              <img src="{{ url('user/no_photo/no_photo.png') }}">
                                          @endif
                                        </span>
                                        <span>{!!$user->name!!}</span>     
                                    </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                      @endif

                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                </form>
            </div>
          @else
            <h3 class="text-danger">You only can send message to your coursemates and teachers.</h3>
          @endif



	    </div>
	</div>
</section>

@endsection