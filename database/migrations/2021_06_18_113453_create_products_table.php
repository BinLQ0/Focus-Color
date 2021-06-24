<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 100)->unique('products_code_unique');
			$table->string('unit')->nullable();
			$table->text('description')->nullable();
			$table->bigInteger('inventory_id')->default(0)->index('products_product_type_id_foreign');
			$table->bigInteger('warehouse_id')->default(1);
			$table->timestamps(10);
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
		Schema::drop('products');
	}
}
