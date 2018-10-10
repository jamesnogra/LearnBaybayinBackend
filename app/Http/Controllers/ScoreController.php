<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Score;
use App\Total_Score;

class ScoreController extends Controller
{
    function postAddScore(Request $request) {
    	$user = User::where('login_token', $request->login_token)->first();
        if ($user) {
        	//delete first the existing score if there is one
        	Score::where('user_id', $user->id)->where('stage', $request->stage)->where('level', $request->level)->delete();
            //add the score
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

    function getScore(Request $request) {
    	$user = User::where('login_token', $request->login_token)->first();
        return Score::where('user_id', $user->id)->get();
    }

    function postTotalScores(Request $request) {
        $user = User::where('login_token', $request->login_token)->first();
        $counter = 1;
        $temp_scores = [];
        $temp_scores['user_id'] = $user->id;
        foreach ($request->scores as $score) {
            $temp_scores['score_stage_'.$counter] = $score;
            $counter++;
        }
        Total_Score::create($temp_scores);
        return $temp_scores;
    }
}
