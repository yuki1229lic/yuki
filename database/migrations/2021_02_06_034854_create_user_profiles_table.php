<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name_kana')->nullable();
            $table->string('first_name_kana')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('sex')->nullable();
            $table->string('province')->nullable();
            $table->integer('car')->nullable();
            $table->integer('experience')->nullable();
            $table->string('phone')->nullable();
            $table->text('img')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
