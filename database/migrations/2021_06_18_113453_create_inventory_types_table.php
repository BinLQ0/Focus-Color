<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTypesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_types', function (Blueprint $table) {
			$table->bigInteger('id', true)->unsigned();
			$table->string('name');
			$table->string('description')->nullable()->default('');
			$table->integer('is_material')->nullable()->default(0);
			$table->integer('is_goods')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventory_types');
	}
}
