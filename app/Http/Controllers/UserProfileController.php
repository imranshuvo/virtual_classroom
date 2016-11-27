<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Auth;

class UserProfileController extends Controller
{
    //


    public function getProfile(){
    	$user = Auth::user();
        
    	return view('user.user-profile')->with(['user' => $user]);
    }

}
