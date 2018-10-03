<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function postRegister(Request $request) {
    	$new_user = new User;
    	$new_user->email = $request->email;
    	$new_user->name = $request->name;
    	$new_user->age = $request->age;
    	$new_user->gender = $request->gender;
    	$new_user->education = $request->education;
    	$new_user->password = Hash::make($request->password);
    	$new_user->save();
    	return $new_user;
    }
}
