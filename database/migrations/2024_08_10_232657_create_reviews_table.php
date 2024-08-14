<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->text('body');
			$table->integer('stars');
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}