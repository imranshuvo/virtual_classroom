<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CourseController extends Controller
{
    //

    public function getCreateCourseView(){
    	return view('courses.create');
    }


    public function create(Request $req){
    	$data = [
    		'name' => $req->input('name'),
    		'category_id' => $req->input('category_id'),
    		'class_number' => $req->input('class_number'),
    		'user_id' => $req->user()->id,
    		'max_allowed_student' => $req->input('max_allowed_student'),
    		'start_date' => $req->input('start_date')
     		];

     	$this->validate($req,[
     		'name' => 'required',
     		'category_id' => 'required',
     		'class_number' => 'required',
     		'max_allowed_student' => 'required',
     		'start_date' => 'required'
     		]);

     	$id = \DB::table('courses')->insertGetId($data);
     	if($id != null){
     		return redirect('home')->with('message','Course Created Successfully!');
     	}
    }
}
