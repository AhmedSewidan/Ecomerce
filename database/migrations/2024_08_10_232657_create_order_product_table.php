<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->decimal('price');
			$table->integer('quantity');
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}