<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Course;


class MessagesController extends Controller
{
     /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        
        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
       
        return view('messenger.index', compact('threads', 'currentUserId'));
    }
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Error: Not found!');
            return redirect('messages');
        }
       
        // don't show the current user in list
        $userId = Auth::user()->id;
        //$users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);
        $users = \DB::table('users')->join('participants','participants.user_id','=','users.id')->where('participants.thread_id','=',$id)->get();
        
        foreach($users as $user){
           $ids[] = $user->user_id;
        }
        //restricting other users who are not in conversation from accessing the message
        $user_restrict = in_array(Auth::user()->id, $ids);
        if($user_restrict != true){
            Session::flash('error_message', 'You do not have necessary permission to access the message!');
            return redirect('messages');
        }
        return view('messenger.show', compact('thread', 'users','user_restrict'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = [];
        if(Auth::user()->role_id == 1){
            $courses_enrolled = \DB::table('course_enrolled')->select('course_id')->where('student_id',Auth::user()->id)->get();

            foreach($courses_enrolled as $course){
               $students = \DB::table('course_enrolled')->join('users','users.id','=','course_enrolled.student_id')->where('course_id','=',$course->course_id)->get();

               //dd($users);
               $teachers = \DB::table('users')->join('courses','users.id','=','courses.user_id')->where('courses.id','=',$course->course_id)->get();
            }
            foreach($students as $user){
                if($user->student_id != Auth::user()->id):
                    //check if the student id is not the same as the current student id
                    $users[] = $user;
                endif;
            }

        }else{
            $courses_by_teacher = \DB::table('courses')->where('user_id','=',Auth::user()->id)->select('id')->get();

            foreach($courses_by_teacher as $course ){
                $students = \DB::table('course_enrolled')->where('course_id','=', $course->id)->select('student_id')->get();
            }

            foreach($students as $user){

                $users[] = User::find($user->student_id);
            }
        }


        if(count($users) > 0 ){
            $hide = 0;
        }else{
            $hide = 1;
        }
        //dd($users);
        return view('messenger.create', compact('users','hide'));
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = Input::all();



        $validator = $this->validate($request,
            [
                'subject' => 'required',
                'message' => 'required',
                'recipients' => 'required'
            ]
        );
//        if ($validator->fails())
//        {
//            return redirect()->back()->withErrors($validator->messages());
//        }

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }
        return redirect('messages');
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );
        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }
        return redirect('messages/' . $id);
    }
    
}
