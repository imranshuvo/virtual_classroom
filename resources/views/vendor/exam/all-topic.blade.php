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
        	@include('errors.list')

            @if(Session::has('flash_mess'))
                <div class="alert alert-success">{{Session::get('flash_mess')}}</div>
            @endif

            <div class="col-md-3">
                <!-- left sidebar -->
                <div class="list-group">
                    <a href="{{ url('teacher/my-course') }}/{{ $course->id }}" class="list-group-item"><< Back to course page</a>
                    <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="list-group-item">+ Create an exam topic</a>
                </div>
            </div>

            <div class="col-md-9">

                @if(!$topics->isEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>{{$topic->name}}</td>
                                    <td>{{$topic->duration}} mins</td>
                                    <td>
                                        <h4>
                                        @if($topic->status == 1)
                                            <span class="label label-success">Completed
                                         @else
                                            <span class="label label-warning">Open
                                        @endif

                                            </span>
                                        </h4>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{action('ExamController@getQuestions', [$course->id,$topic->id])}}">Manage Questions</a>
                                        <a class="btn btn-warning" href="{{action('ExamController@getEdit', [$course->id,$topic->id])}}">Edit</a>
                                        <a class="btn btn-danger" id="btn-delete" href="{{action('ExamController@getDelete', [$course->id,$topic->id])}}">Delete</a>
                                    </td>

                                </tr>
                            @endforeach

                        </table>
                    </div>
                @else
                    <span class="alert">No exam topic found for this Course!</span>
                @endif

            </div>
        </div>
    </div>
    @if(count($topics) > 0)
     {{$topics->links()}}
     @endif
</section>
@endsection