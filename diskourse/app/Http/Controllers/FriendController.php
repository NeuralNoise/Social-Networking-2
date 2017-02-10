<?php

namespace Diskourse\Http\Controllers;

use Auth;

use Diskourse\Models\User;

class FriendController extends Controller
{
  public function getIndex()
  {
  	$friends = Auth::user()->friends();
  	$requests = Auth::user()->friendRequests();
 
  	return view('friends.index')
  	  ->with('friends', $friends)
  	  ->with('requests', $requests);
  }
 public function getAdd($username)
 {
     $user = User::where('username',$username)->first();

    if (!$user)
    {
      return redirect()->
      route('home')
      ->with('info','couldnot find the user');
    }

    if (Auth::user()->id === $user->id)
    {
      return redirect()->route('home');
    }

    if (Auth::user()->hasFriendRequestPending($user) || $user->
      hasFriendRequestPending(Auth::user()))
    {
      return redirect()->route('profile.index',['username' => $user->username])
      ->with('info','friend request already send');
    }

    if(Auth::user()->isFriendsWith($user))
    {
      return redirect()->
      route('profile.index',['username' => $user->username])
      ->with('info','you r already friend ');
    }

    Auth::user()->addFriend($user);

    return redirect()->
    route('profile.index', ['username' => $username]) 
    ->with('info','friend request sent');
 }
 public function getAccept($username)
 {
 $user = User::where('username',$username)->first();

    if (!$user)
    {
      return redirect()->
      route('home')
      ->with('info','couldnot find the user');
    }
    if(!Auth::user()->hasFriendRequestReceived($user))
    {
      return redirect()->route('home');
    }

    Auth:: user()->acceptFriendRequest($user);
    return redirect()->route('profile.index',['username' => $username])
    ->with('info','friend request accepted');
 }
 public function postDelete($username)
 {
   $user = User::where('username',$username)->first();

   if (!Auth::user()->isFriendsWith($user))
   {
    return redirect()->back();
   }
   Auth::user()->deleteFriend($user);

   return redirect()->route('home')->with('info','friend deleted');
 }
} 