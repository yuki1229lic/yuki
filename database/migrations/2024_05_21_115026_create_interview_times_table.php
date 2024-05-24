<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_times', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('job_id');
            $table->integer('jober_id');
            $table->date('date');
            $table->boolean('time1')->default(false);
            $table->boolean('time2')->default(false);
            $table->boolean('time3')->default(false);
            $table->boolean('time4')->default(false);
            $table->boolean('time5')->default(false);
            $table->boolean('time6')->default(false);
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
        Schema::dropIfExists('interview_times');
    }
}
