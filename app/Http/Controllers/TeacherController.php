<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\User;

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
        $user = User::find($course->user_id);
        $courses = Course::where('user_id','=',$course->user_id)->get();
    	return view('teacher.course-material')->with(['course' => $course,'user'=> $user,'courses' => $courses]);
    }
}
