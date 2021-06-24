<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relations', function (Blueprint $table) {
			$table->bigInteger('id', true);
			$table->string('name', 50);
			$table->string('address')->nullable()->default('-');
			$table->string('is_supplier')->nullable()->default('0');
			$table->string('is_customer')->nullable()->default('0');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('relations');
	}
}
