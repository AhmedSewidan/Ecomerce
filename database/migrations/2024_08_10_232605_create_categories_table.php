<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->id('id');
			$table->string('title', 100);
			$table->text('photo')->nullable();
            $table->boolean('status');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}