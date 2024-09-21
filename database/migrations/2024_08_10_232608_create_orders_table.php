<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->id('id');
			$table->unsignedBigInteger('client_id');
			$table->unsignedBigInteger('address_id');
			$table->enum('pay', array('fawry', 'vodafone-cash', 'vesa', 'paypal', 'upon-delivary'));
			$table->enum('status', array('in-cart', 'canceled', 'pending', 'accepted', 'delivered'));
			$table->decimal('total');
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('address_id')->references('id')->on('addresses')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}