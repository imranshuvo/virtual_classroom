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

            <div class="col-md-4">
                <!-- User image goes here -->
            
            </div>
            <div class="col-md-8">
                <!-- User bio goes here -->
                <h2 class="user-name">{{ $user->name }}</h2>    
            </div>

        </div>
    </div>
</section>

@endsection