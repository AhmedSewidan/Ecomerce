<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
<<<<<<<< HEAD:database/migrations/2024_08_10_232605_create_categories_table.php
			$table->string('title', 100);
			$table->text('photo')->nullable();
========
			$table->string('title');
			$table->string('photo')->nullable();
>>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674:database/migrations/2024_08_10_232640_create_categories_table.php
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}