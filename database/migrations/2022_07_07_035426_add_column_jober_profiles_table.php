<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJoberProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jober_profiles', function (Blueprint $table) {
            $table->text('company_logo_img')->nullable()->after('company_img');
            $table->string('company_establish_date')->nullable()->after('company_business_content');
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
            $table->dropColumn('company_logo_img');
            $table->dropColumn('company_establish_date');
        });
    }
}
