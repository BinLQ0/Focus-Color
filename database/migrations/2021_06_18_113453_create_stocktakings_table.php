<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocktakingsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stocktakings', function (Blueprint $table) {
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('product_id');
			$table->date('date');
			$table->string('note');
			$table->float('quantity', 8, 3)->default(0.000);
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stocktakings');
	}
}
