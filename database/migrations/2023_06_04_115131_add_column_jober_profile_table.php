<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJoberProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jober_profiles', function (Blueprint $table) {
            $table->text('company_employee')->nullable()->after('company_establish_date');
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
            $table->dropColumn('company_employee');
        });
    }
}
