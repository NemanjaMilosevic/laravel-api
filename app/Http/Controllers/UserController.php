<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
	{

		return User::all(); 

	}

	public function show(User $user)
    {
        return $user;
    }

	public function delete()
	{
		$user = Auth::user(); 
		Auth::logout();
		$user->active = 0;
		$user->delete();
	    return response()->json('Success', 200);
	}

	
}



