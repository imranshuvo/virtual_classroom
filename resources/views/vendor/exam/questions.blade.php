@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Question Management : <b>{{ $topic->name }}</b></h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
            @include('errors.list')

            @if(Session::has('flash_mess'))
                <div class="alert alert-success">{{Session::get('flash_mess')}}</div>
            @endif

            <div class="col-md-3">
                <!-- left sidebar -->
                <div class="list-group">
                    <a href="{{ url('teacher/my-course') }}/{{ $course->id }}" class="list-group-item"><< Back to course page</a>
                    <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all" class="list-group-item">All exam topic</a>
                    <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="list-group-item">+ Create an exam topic</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="question-topic">
                        <h3>Course Name: <b>{{ $course->title }}</b></h3>
                        <h3>Topic Name: <b>{{ $topic->name }}</b></h3>
                        <h3>Duration: <b>{{ $topic->duration }}</b> minutes</h3>
                    </div>
                </div>
                <div class="row">
                     <button type="button" class="btn btn-primary" id="btn-add-new-question"><span class="glyphicon glyphicon-plus"></span> Add new question</button>

                     <br><br><br>
                     <form class="form-horizontal" method="post" action="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id }}/question/create" id="add-new-question">
                         @include('vendor.exam.question-form')

                </div>

                <div class="row"> 
                    @if(!$questions->isEmpty())
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> Questions added</div>

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($questions as $question)

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading{{$question->id}}">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$question->id}}" aria-expanded="false" aria-controls="collapse{{$question->id}}">
                                                    Question #{{$question->id}} : <b>{{ $question->question }}</b>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$question->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$question->id}}">
                                            <div class="panel-body">
                                                <form class="form-horizontal" id="add-new-question" method="post" action="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id }}/question/{{ $question->id }}/update">
                                                @include('vendor.exam.question-form')

                                            </div>
                                        </div>
                                    </div>

                            @endforeach
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection