<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWebResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_web_resumes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->tinyInteger('user_basic_status')->default(0);
            $table->string('user_postal_code')->nullable();
            $table->string('user_province')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_station')->nullable();
            $table->string('user_education')->nullable();
            $table->tinyInteger('user_drive_license')->default(0);
            $table->string('user_salary')->nullable();
            $table->tinyInteger('user_back_pain')->default(0);
            $table->tinyInteger('user_epilepsy')->default(0);
            $table->tinyInteger('user_mental')->default(0);
            $table->tinyInteger('user_tattoos')->default(0);
            $table->tinyInteger('user_hurt')->default(0);
            $table->tinyInteger('user_insomnia')->default(0);
            $table->text('user_condition')->nullable();
            $table->tinyInteger('user_experience_status')->default(0);
            $table->string('user_company_name')->nullable();
            $table->text('user_period')->nullable();
            $table->text('user_company_history')->nullable();
            $table->tinyInteger('user_qualification_status')->default(0);
            $table->text('user_qualification1')->nullable();
            $table->text('user_qualification2')->nullable();
            $table->tinyInteger('user_skill_status')->default(0);
            $table->tinyInteger('user_skill_1')->default(0);
            $table->tinyInteger('user_skill_2')->default(0);
            $table->tinyInteger('user_skill_3')->default(0);
            $table->tinyInteger('user_skill_4')->default(0);
            $table->tinyInteger('user_skill_5')->default(0);
            $table->tinyInteger('user_skill_6')->default(0);
            $table->tinyInteger('user_skill_7')->default(0);
            $table->tinyInteger('user_skill_8')->default(0);
            $table->tinyInteger('user_skill_9')->default(0);
            $table->tinyInteger('user_skill_10')->default(0);
            $table->text('user_skill_capable')->nullable();
            $table->tinyInteger('user_business_capable')->default(0);
            $table->tinyInteger('user_history_status')->default(0);
            $table->text('user_history_1')->nullable();
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
        Schema::dropIfExists('user_web_resumes');
    }
}
