<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhotosTable extends Migration {

	public function up()
	{
		Schema::create('product_photos', function(Blueprint $table) {
			$table->id('id');
			$table->unsignedBigInteger('product_id');
			$table->text('photo')->nullable();
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