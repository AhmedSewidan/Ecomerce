<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhotosTable extends Migration {

	public function up()
	{
		Schema::create('product_photos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
<<<<<<< HEAD
			$table->text('photo')->nullable();
=======
			$table->string('photo')->nullable();
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
			$table->foreign('product_id')->references('id')->on('products')
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('product_photos');
	}
}