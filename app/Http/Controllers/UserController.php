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
    	$new_user->login_token = generateRandomString(16);
    	$new_user->save();
    	return $new_user;
    }

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
