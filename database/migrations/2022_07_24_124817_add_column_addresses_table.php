<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

class AddColumnAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->integer('ken_group_id')->default(0)->after('town_id');
            $table->integer('city_group_id')->default(0)->after('ken_group_id');
            $table->string('ken_group_name', 32)->nullable()->after('office_addresses');
            $table->string('city_group_name', 32)->nullable()->after('ken_group_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->dropColumn('ken_group_id');
            $table->dropColumn('city_group_id');
            $table->dropColumn('ken_group_name');
            $table->dropColumn('city_group_name');
        });
    }
}
