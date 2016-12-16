@extends('layouts.app')


@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
            </div>
        </div>
    </div>
</section>



<section class="p-v-xxl bg-light">
    <div class="row p-t-xxl bg-info content">

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
</section>



@endsection