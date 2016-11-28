<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Topic;

class StudentController extends Controller
{
    //Show all courses of a student

    public function showAllCourses(Request $req){
    	$student_id = $req->user()->id;
    	$courses = \DB::table('courses')
    				->join('course_enrolled', function($join){
    					 $join->on('courses.id','=','course_enrolled.course_id');
    				})
    				->where('course_enrolled.student_id','=',$student_id)
    				->get();
    	
    	return view('student.courses')->with(['courses' => $courses]);

    }

    //single material course page
    public function singleCourseMaterialPage($id){
        $course = Course::find($id);
    	return view('student.course-material')->with(['course' => $course]);
    }


    //Get the private profile of Student
    public function getPrivateProfile(Request $req){
        $st_information = $req->user();
        if(!empty($st_information) || count($st_information) > 0) {
            return view('student.profile-private')->with(['user' => $st_information]);
        }
    }


    //Get the open exam view page
    public function getOpenExamsPage($course_id){
        $course = Course::find($course_id);
        $exams = Topic::where('course_id',$course_id)->where('status',0)->get();
        return view('student.open-exams')->with(['exams' => $exams, 'course' => $course ]);
    }


}
