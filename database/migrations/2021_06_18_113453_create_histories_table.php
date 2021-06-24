<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('histories', function (Blueprint $table) {
			$table->integer('histories_id');
			$table->string('histories_type');
			$table->bigInteger('product_id');
			$table->bigInteger('warehouse_id')->default(1);
			$table->float('quantity');
			$table->bigInteger('rack_id')->unsigned()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('histories');
	}
}
