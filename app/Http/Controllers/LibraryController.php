<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LibraryController extends Controller
{
    //


    public function getBooks(){
    	$books = \DB::table('library')->get();
    	return view('vendor.library.show')->with(['books' => $books]);
    }


    public function addBookView(){
    	$enable = '';
    	$user = \Auth::user();
    	$courses = \DB::table('courses')->where('user_id','=',$user->id)->select('id','title')->get();
    	if($user->role_id == 2 && count($courses) > 0 ){
    		$enable = 'yes';
    	}else{
    		$enable = 'no';
    	}
    	return view('vendor.library.create')->with(['is_enabled' => $enable,'courses' => $courses]);
    }

    public function saveBook(Request $req){
    	$book = $req->file('book_link');
    	$bookName = $book->getClientOriginalName();
        $url = time(). $bookName;
        $destination = public_path('library/books');
        $data = [
        	'uploader_id' => $req->input('uploader_id'),
        	'course_id'  => $req->input('course_id'),
        	'author_name' => $req->input('author_name'),
        	'book_name' => $req->input('book_name'),
        	'book_link' => $url,
        	'online_link' => $req->input('online_link')
        ];

        $this->validate($req,[
        	'course_id' => 'required',
        	'author_name' => 'required',
        	'book_name' => 'required',
        	'book_link' => 'mimes:pdf',
        	]);

        if($book->move($destination,$url)){
            $id = \DB::table('library')->insertGetId($data);
        }
        if($id != null){
        	return redirect()->back()->with('message', 'Book is successfully added to the library.');       
		}

    }
}
