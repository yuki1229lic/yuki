<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAddressUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->integer('zip')->nullable()->after('province');
            $table->integer('ken_id')->nullable()->after('zip');
            $table->integer('city_id')->nullable()->after('ken_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('zip');
            $table->dropColumn('ken_id');
            $table->dropColumn('city_id');
        });
    }
}
