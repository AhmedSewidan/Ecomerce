<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('password', 250);
			$table->string('phone', 11);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}