<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjustments', function (Blueprint $table) {
			$table->bigInteger('id', true)->unsigned();
			$table->date('date');
			$table->string('for')->default('-');
			$table->string('description')->nullable()->default('-');
			$table->timestamps(10);
			$table->string('status', 191)->default('Upload Completed');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adjustments');
	}
}
