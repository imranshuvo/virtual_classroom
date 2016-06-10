@extends('layouts.app')


@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Congratulation!</div>

                <div class="panel-body">
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
            </div>
        </div>
    </div>
</div>



@endsection