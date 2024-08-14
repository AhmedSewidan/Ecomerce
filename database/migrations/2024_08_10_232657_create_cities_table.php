<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('governorate_id')->unsigned();
			$table->string('title', 100);
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}