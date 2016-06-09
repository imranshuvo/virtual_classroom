<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    //

    public function login(){
    	return 'Login';
    }

    public function signup(){
    	return 'signup';
    }
}
