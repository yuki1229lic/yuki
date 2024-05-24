<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('view')->default(0)->after('special_job');
            $table->integer('post_payment_type')->nullable()->default(0)->after('post_working_time');
            $table->text('post_payment_text')->nullable()->after('post_payment');
            $table->text('post_working_time_type')->nullable()->after('post_working_time');
            $table->text('post_selection')->nullable()->after('post_working_place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // 閲覧数
            $table->dropColumn('view');
            $table->dropColumn('post_payment_type');
            $table->dropColumn('post_payment_text');
            $table->dropColumn('post_suitable');
            $table->dropColumn('post_working_time_type');
            $table->dropColumn('post_selection');
        });
    }
}
