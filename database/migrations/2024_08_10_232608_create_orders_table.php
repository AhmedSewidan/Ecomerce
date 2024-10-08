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
			$table->unsignedBigInteger('order_address_id')->nullable();
			$table->string('code')->nullable();
			$table->enum('pay', array('fawry', 'vodafone-cash', 'vesa', 'paypal', 'upon-delivary'))->nullable();
			$table->enum('status', array('in-cart', 'canceled', 'pending', 'accepted', 'delivered'))->default('in-cart');
            $table->text('comment')->nullable();
			$table->decimal('total')->nullable();
			$table->timestamp('expires_at')->nullable();
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('order_address_id')->references('id')->on('order_addresses');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}