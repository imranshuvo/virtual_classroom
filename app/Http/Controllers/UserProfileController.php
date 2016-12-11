<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Image;


use Auth;

class UserProfileController extends Controller
{
    //


    public function getProfile(){
    	$user = User::where('id',Auth::user()->id)->join('roles','roles.id','=','users.role_id')->get();
        return $user;
        
    	return view('user.user-profile')->with(['user' => $user]);
    }


    //Upload profile photo 
    public function uploadPhoto(Request $req){
    	$image = $req->file('profile-photo');
    	$url = $this->imageManipulate($image);

        $this->validate($req,[
                'profile_photo' => 'mimes:jpeg,png'
            ]);
        $user = User::find($req->user()->id);
        $user->profile_photo = $url;
        if($user->save()){
            return back()->with('message','Photo added successfully');
        }


	    
    }

    public function imageManipulate($obj){
        $image = $obj;
        $url = $this->resize($image,300,'thumb');       
        return $url;
    }


    public function resize($image,$size,$type){
        try{
            $extension      =   $image->getClientOriginalExtension();
            $imageRealPath  =   $image->getRealPath();
            $thumbName      =   $type.'_'. $image->getClientOriginalName();
            
            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);
        
            $img = Image::make($imageRealPath); // use this if you want facade style code
            $img->resize(intval($size), null, function($constraint) {
                 $constraint->aspectRatio();
            });
            $path = public_path('user/imgs').'/'.time(). $thumbName;
            $image_url = str_replace('/var/www/html/virtual_classroom/public','',$path);
            $img->save($path);

            return $image_url;

        }catch(Exception $e){

            return false;
        }
    }

}
