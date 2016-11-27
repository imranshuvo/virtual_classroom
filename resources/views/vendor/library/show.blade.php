@extends('layouts.app')

@section('content')

<section class="bg-dark">
	<div class="container">
	    <div class="row p-t-xxl">
	        <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
	            <h1 class="h1 m-t-l p-v-l">Library</h1>
	        </div>
	    </div>
	</div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">

    	<div class="row bg-info content" style="padding-top:25px;padding-bottom: 25px;padding-left: 25px; ">
    	@if(Auth::check())
    		@if(Auth::user()->role_id == 2)
        		<a href="{{ url('vc/library/new') }}">+ Add New Book</a>
        	@endif
        @endif
    	</div>
        <div class="row p-t-xxl bg-info content">

            <div class="col-md-12 ">
            	@if(count($books) > 0)

            	<ul>
            		<table class="table table-hover">
					    <thead>
					      <tr>
					        <th>No.</th>
					        <th>Book Name</th>
					        <th>Author Name</th>
					      </tr>
					    </thead>
					    <tbody>
	                		@foreach($books as $book)
					    	<tr>
					        	<td>{{ $book->id }}</td>
					        	<td><a href="../library/books/{{ ($book->book_link) }}" target="_blank">{{ $book->book_name }}</a></td>
					        	<td>{{ $book->author_name }}</td>
					        </tr>
		            		@endforeach

					    </tbody>
					  </table>
            	</ul>
            	@else
            		<span class="bg-danger alert-danger">No books in the library!</span>
            	@endif
            </div>
        </div>
    </div>
</section>

@endsection