<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

class TeacherController extends Controller
{
    //

    public function getAllCourses(Request $req){
    	$user = $req->user()->id;
    	$courses = \DB::table('courses')->where('user_id','=',$user)->get();
    	return view('teacher.courses')->with(['courses' => $courses,'type' => 'teacher']);
    }


    //single material course page
    public function singleCourseMaterialPage($id){
        $course = Course::find($id);
    	return view('courses.class')->with(['course' => $course]);
    }
}
