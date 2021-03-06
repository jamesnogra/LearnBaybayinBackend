<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function postRegister(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $check_user = User::where('email', $request->email)->first();
        if ($check_user) {
            return [
                'status'    => 2,
                'message'   => 'Email already exists.',
                'user'    => [],
            ];
        }

    	$new_user = new User;
    	$new_user->email = $request->email;
    	$new_user->name = $request->name;
    	$new_user->age = $request->age;
    	$new_user->gender = $request->gender;
        $new_user->education = $request->education;
    	$new_user->type = $request->type;
    	$new_user->password = Hash::make($request->password);
    	$new_user->login_token = $this->generateRandomString(16);
    	$new_user->save();

        Mail::send('sign-up', ['user' => $new_user], function ($m) use ($new_user) {
            $m->from('james@iamcebu.com', 'Learn Baybayin Admin');
            $m->to($new_user->email, $new_user->name)->subject('Thanks for signing up...');
        });

    	return [
            'status'    => 1,
            'message'   => 'OK',
            'user'    => $new_user
        ];
    }

    function postUpdateFavoriteSubjects(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $user = User::where('login_token', $request->login_token)->update(['favorite_subjects'=>$request->favorite_subjects]);
        return [
            'status'    => 1,
            'message'   => 'OK',
            'user'    => $user
        ];
    }

    function postCheckToken(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $user = User::where('login_token', $request->login_token)->first();
        if ($user) {
            return [
                'status'    => 1,
                'message'   => 'OK',
                'user'    => $user
            ];
        }
        return [
            'status'    => 2,
            'message'   => 'Login token is invalid or expired.',
            'user'    => []
        ];
    }

    function postLogin(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                //update the login token
                $user->login_token = $this->generateRandomString(16);
                User::where('email', $request->email)->update(['login_token'=>$user->login_token]);
                return [
                    'status'    => 1,
                    'message'   => 'OK',
                    'user'    => $user
                ];
            }
        }
        return [
            'status'    => 2,
            'message'   => 'Invalid email or password!',
            'user'    => []
        ];
    }

	function generateRandomString($length = 10) {
        header('Access-Control-Allow-Origin: *');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
