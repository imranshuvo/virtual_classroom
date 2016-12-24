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
                    @if($errors->any())
                        <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                            <span class="arrow left pull-up arrow-danger"></span>
                            <p class="m-b-none text-white">{{$errors->first()}}</p>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                            <span class="arrow left pull-up arrow-success"></span>
                            <p class="m-b-none text-white">{{ session('message') }}</p>
                        </div>
                    @endif

                    @if(isset($message))
                        <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                            <span class="arrow left pull-up arrow-success"></span>
                            <p class="m-b-none text-white">{{ $message }}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</section>



@endsection