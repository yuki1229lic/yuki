<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullnameUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('fullname')->nullable()->after('first_name');
            $table->string('fullname_kana')->nullable()->after('first_name_kana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jober_profiles', function (Blueprint $table) {
            $table->dropColumn('fullname');
            $table->dropColumn('fullname_kana');
        });
    }
}
