<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration {

	public function up()
	{
		Schema::create('addresses', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->text('address_line');
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('addresses');
	}
}