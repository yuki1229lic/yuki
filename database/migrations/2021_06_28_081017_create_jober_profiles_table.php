<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoberProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jober_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('jober_id');
            $table->string('company_name')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_province')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_leader')->nullable();
            $table->string('company_task_manager')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_url')->nullable();
            $table->text('company_img')->nullable();
            $table->text('company_business_content')->nullable();
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
        Schema::dropIfExists('jober_profiles');
    }
}
