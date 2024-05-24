<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobWorkingPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_working_places', function (Blueprint $table) {
            $table->id();
            $table->integer('jober_id');
            $table->integer('job_id');
            $table->integer('ken_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('ken_name')->nullable();
            $table->string('city_name')->nullable();
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
        Schema::dropIfExists('job_working_places');
    }
}
