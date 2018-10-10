<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TotalScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->integer('score_stage_0')->nullable();
            $table->integer('score_stage_1')->nullable();
            $table->integer('score_stage_2')->nullable();
            $table->integer('score_stage_3')->nullable();
            $table->integer('score_stage_4')->nullable();
            $table->integer('score_stage_5')->nullable();
            $table->integer('score_stage_6')->nullable();
            $table->integer('score_stage_7')->nullable();
            $table->integer('score_stage_8')->nullable();
            $table->integer('score_stage_9')->nullable();
            $table->integer('score_stage_10')->nullable();
            $table->integer('score_stage_11')->nullable();
            $table->integer('score_stage_12')->nullable();
            $table->integer('score_stage_13')->nullable();
            $table->integer('score_stage_14')->nullable();
            $table->integer('score_stage_15')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
