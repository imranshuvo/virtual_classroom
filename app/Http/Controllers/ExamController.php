<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Topic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\TopicRequest;
use App\Question;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //

	//Get all the exam topics for one course
     public function index($course_id){
        $topics = Topic::where('course_id',$course_id)->paginate(5);
        $title = "Topics";
        $course = Course::find($course_id);
        return view('vendor.exam.all-topic')->with(['topics' => $topics, 'title' => $title,'course' => $course ]);
    }


    //Create a new topic for the course exam
    public function createNewTopic($course_id, Request $req){

        $topic = new Topic($req->all());
        $course = Course::find($req->input('course'));
        $course->topics()->save($topic);
        session()->flash('flash_mess', 'Topic was created completely');
		return redirect()->action('ExamController@index', ['course_id' => $course_id]);
    }


    //Get the new topic create view
    public function getNewTopicCreateView($course_id){
    	$course = Course::find($course_id);
    	return view('vendor.exam.new-topic')->with(['course' => $course]);
    }


    // get Edit the topic view
    public function getEdit($course_id,$topic_id){
    	$topic = Topic::findOrFail($topic_id);
        $title = "Edit topic '{$topic->name}'";
        $course = Course::find($course_id);
        return view('vendor.exam.edit-topic')->with(['topic' => $topic,'title' => $title,'course' => $course]);
    }

    //Delete the topic
    public function getDelete($course_id, $topic_id){
    	 $topic = Topic::findOrFail($topic_id);
        Topic::destroy($topic_id);
        session()->flash('flash_mess', 'Topic  was deleted');
		return redirect()->action('ExamController@index', ['course_id' => $course_id]);
    }


    //Update the topic
    public function updateTopic($course_id,$topic_id, Request $req){

    	$data = [
    		'name' => $req->input('name'),
    		'course_id' => $req->input('course'),
    		'duration' => $req->input('duration'),
    		'status' => $req->input('status')
    	];
    	$this->validate($req,[
    		'name' => 'required',
    		'duration' => 'required'
    		]);
    	$topic = Topic::find($topic_id);
    	$topic->update($data);
    	return redirect()->action('ExamController@index',['course_id' => $course_id]);

    }



      // Get the questions of topic
    public function getQuestions($course_id,$topic_id){
    	$topic = Topic::findOrFail($topic_id);
        $title = "Manage questions";
        $answer = ['1'=>1, '2'=>2,'3'=> 3,'4'=> 4];
        $questions = $topic->questions;
        $title_button = "Save question";
        $course = Course::find($course_id);
        //dd($questions);
        return view('vendor.exam.questions')->with(['topic' => $topic,'title' => $title, 'answer' => $answer , 'questions' => $questions, 'title_button' => $title_button, 'course' => $course]);
    }

    //Create a New question
    public function postNewQuestion($course_id,$topic_id, Request $req){
    	$topic = Topic::find($topic_id);
    	$question = new Question($req->all());
    	$topic->questions()->save($question);
    	session()->flash('flash_mess','Question was added successfully.');
    	return redirect(action('ExamController@getQuestions',['course_id' => $course_id,'id' => $topic_id]));
    }

    //Delete the question
    public function deleteQuestion($course_id,$topic_id,$question_id){
        Question::destroy($question_id);
        session()->flash('flash_mess', 'Question #'.$question_id.' was deleted');
        return redirect(action('ExamController@getQuestions', ['course_id'=> $course_id, 'id' =>  $topic_id ]));
    }

    //Update the question
    public function updateQuestion($course_id,$topic_id,$question_id,Request $req){
    	$question = Question::findOrFail($question_id);
        $question->update($req->all());
        session()->flash('flash_mess', 'Question #'.$question->id.' was changed completely');
        return redirect(action('ExamController@getQuestions', ['course_id'=> $course_id, 'id' => $topic_id ]));
    }

    

}
