<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id('id');
			$table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
			$table->string('title', 100);
			$table->text('photo');
            $table->decimal('discount')->nullable();
			$table->decimal('price');
			$table->integer('quantity');
			$table->text('description')->nullable();
			$table->boolean('status')->default(1);
            $table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}