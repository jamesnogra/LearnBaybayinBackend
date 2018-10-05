<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Score;

class ScoreController extends Controller
{
    function postAddScore(Request $request) {
    	$user = User::where('login_token', $request->login_token)->first();
        if ($user) {
            $new_score = new Score;
            $new_score->user_id = $user->id;
            $new_score->score = $request->score;
            $new_score->time = $request->time;
            $new_score->stage = $request->stage;
            $new_score->level = $request->level;
            $new_score->character = $request->character;
            $new_score->details = $request->details;
            $new_score->save();
            return [
	            'status'    => 1,
	            'message'   => 'OK',
	            'user'    	=> $new_score
	        ];
        }
        return [
            'status'    => 2,
            'message'   => 'Login token is invalid or expired.',
            'user'    	=> []
        ];
    }
}
