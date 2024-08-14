<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}