<?php

namespace Diskourse\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use Diskourse\Models\User;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup');
	}
	public function postSignup(Request $request)
	{
    $this->validate($request,[
    'email' => 'required|unique:users|email|max:255',
    'username' => 'required|unique:users|alpha_dash|max:10',
    'password' => 'required|min:6',
    	]);
    User::create([
       'email' => $request->input('email'),
       'username' => $request->input('username'),
       'password' => bcrypt($request->input('password')),
    	]);

    return redirect()
    ->route('home')
    ->with('info','you have sucessfully created an account....plz sign in now');
	}
  public function getSignin()
  {
  return view('auth.signin');
  }
  public function postSignin(Request $request)
  {
     $this->validate($request ,[
     'email' => 'required',
     'password' => 'required',
      ]);
     if (!Auth::attempt($request->only(['email','password']),$request->has('remember')))
     {
      return redirect()->route('home')->with('info','failed');
     }
     return redirect()->route('home')->with('info','sucessful');
  }
  public function getSignout()
  {
    Auth::logout();
    return redirect()->route('home')->with('info','you are signout of your account');
  }
}