<?php

namespace Diskourse\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use Diskourse\Models\User;

class ProfileController extends Controller
{
	public function getProfile($username)
	{
		$user = User::Where('username',$username)->first();

			if(!$user){
          abort(404);
			}
			$statuses = $user->statuses()->notReply()->get();
		return view('profile.index') 
		->with('user',$user)
		->with('statuses',$statuses)
		->with('authUserIsFriend',Auth::user()->isFriendsWith($user));
	}
	public function getEdit()
	{
		return view('profile.edit');
	}
	public function postEdit(Request $request)
	{
        $this->validate($request,[
        'first_name' =>'alpha|max:50' ,
        'last_name' =>'alpha|max:50',
        	]);
   Auth::user()->update([
    'first_name' => $request->input('first_name'),
    'last_name' => $request->input('last_name'),
   	]);
   return redirect()->route('profile.edit')->with('info','you have sucessfully updated your account');
	}

	public function getVideos() {
		return view('profile.video');
	}
	public function postVideos()
	 {

	}
}