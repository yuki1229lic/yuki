<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->integer('id')->default(0)->primary();
			$table->integer('ken_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('town_id')->nullable();
			$table->string('zip', 8)->nullable();
			$table->boolean('office_flg')->nullable();
			$table->boolean('delete_flg')->nullable();
			$table->string('ken_name', 8)->nullable();
			$table->string('ken_furi', 8)->nullable();
			$table->string('city_name', 24)->nullable();
			$table->string('city_furi', 24)->nullable();
			$table->string('town_name', 32)->nullable();
			$table->string('town_furi', 32)->nullable();
			$table->string('town_memo', 16)->nullable();
			$table->string('kyoto_street', 32)->nullable();
			$table->string('block_name', 64)->nullable();
			$table->string('block_furi', 64)->nullable();
			$table->string('memo')->nullable();
			$table->string('office_name')->nullable();
			$table->string('office_furi')->nullable();
			$table->string('office_addresses')->nullable();
			$table->string('new_id', 64)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
