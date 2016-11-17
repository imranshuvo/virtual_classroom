<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Requests;
Use App\Course;
use App\Image;

class CourseController extends Controller
{
    //

    public function getCreateCourseView(){
    	return view('courses.create');
    }



    //Create a course 

    public function create(Request $req){
        $image = $req->file('image');

        $thumb = $this->imageManipulate($image,250,250);

        return $thumb;
        $full = $this->imageManipulate($image,1024,768);

        // replace the point from the european date format with a dash
        $date = str_replace('/', '-', $req->input('start_date'));
        // create the mysql date format
        $date = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
    	$data = [
    		'title' => $req->input('title'),
    		'category_id' => $req->input('category_id'),
    		'class_number' => $req->input('class_number'),
    		'user_id' => $req->user()->id,
    		'max_allowed_student' => $req->input('max_allowed_student'),
    		'start_date' => $date,
    		'description' => $req->input('description')
     		];

     	$this->validate($req,[
     		'title' => 'required',
     		'category_id' => 'required',
     		'class_number' => 'required',
     		'max_allowed_student' => 'required',
     		'start_date' => 'required',
     		'description' => 'required'
     		]);
        
     	$id = \DB::table('courses')->insertGetId($data);
     	if($id != null){
     		return redirect('home')->with('message','Course Created Successfully!');
     	}
    }



    // Show all courses 
    public function showAll(){
    	$courses = \DB::table('courses')->join('users','users.id', '=','courses.user_id')
                    ->select('courses.*','users.name')->get();
    	return view('courses.courses')->with(['courses' => $courses]);
    }

    //Show single course
    public function showSingle($id){
        $course = Course::find($id);
    	return view('courses.single')->with(['course' => $course]);
    }


    //Enroll a student

    public function enroll(Request $req, $id){
        $course_id = $id;
        $user_id = $req->user()->id;
        $enrolled_id = \DB::table('course_enrolled')->where([
                [ 'course_id', $course_id ],
                [ 'student_id', $user_id ]
            ])->get();
        if(count($enrolled_id) < 1 ){
            if($course_id != null && !empty($course_id)){
            \DB::table('course_enrolled')->insert([
                    'course_id' => $course_id,
                    'student_id' => $user_id
                ]);
            return view('courses.thanks')->with(['message' => 'Ureka! You have successfully enrolled!']);
            }else{
                return \Redirect::back()->withErrors(['Something went wrong! You can not enrolled in this course this right now!']);
            }
        }else{
            return \Redirect::back()->withErrors(['You are already enrolled in this course!']);
        }
        
    }



    // Search functionality 

    public function search(Request $req){
        $search_criteria = $req->input('search');
        $this->validate($req,[
            'search' => 'required'
            ]);
        $courses = \DB::table('courses')->where('name','like','%'.$search_criteria.'%')->get();
        return view('courses.courses')->with(['courses' => $courses,'type' => 'student']);
    }


    public function imageManipulate($obj,$width,$height){
        $image = \Image::make($obj)->resize($width,$height);
        $path = $obj->getRealPath();
        $dest = public_path('course/imgs/');
        $fileName = $dest.'/'.rand(1111,55555).'.'.$obj->getClientOriginalExtension();
        $name = $obj->getClientOriginalName();
        $url = $image->save($fileName);
        return $url;
    }
}
