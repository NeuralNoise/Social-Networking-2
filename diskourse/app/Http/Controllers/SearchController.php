<?php

namespace Diskourse\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use Diskourse\Models\User;

class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = $request->input('query');
		
		if(!$query)
		{
			return redirect()->route('home');
		}
		$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)") , 'LIKE' ,"%{$query}")
			->OrWhere('username' , 'LIKE' , "%{$query}%" )
			->get();  

		return view('search.results')->with('users', $users);
	}
}