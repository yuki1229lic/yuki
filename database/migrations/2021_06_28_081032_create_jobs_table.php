<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('jober_id');
            $table->text('post_title')->nullable();
            $table->text('post_img')->nullable();
            $table->text('post_category')->nullable();
            $table->text('post_working_place')->nullable();
            $table->text('post_benefit')->nullable();
            $table->text('post_working_time')->nullable();
            $table->text('post_payment')->nullable();
            $table->text('post_revenue')->nullable();
            $table->text('post_rental_car')->nullable();
            $table->text('post_require')->nullable();
            $table->text('post_other')->nullable();
            $table->integer('post_status')->default(0);
            $table->date('post_expired')->nullable();
            $table->integer('feature_job')->default(0);
            $table->integer('special_job')->default(0);
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
        Schema::dropIfExists('jobs');
    }
}
