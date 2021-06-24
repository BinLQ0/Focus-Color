<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('racks', function (Blueprint $table) {
			$table->bigInteger('id', true)->unsigned();
			$table->string('code', 191);
			$table->string('note', 191)->nullable();
			$table->bigInteger('warehouse_id')->unsigned()->index('racks_warehouse_id_foreign');
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
		Schema::drop('racks');
	}
}
