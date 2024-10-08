<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_addresses', function (Blueprint $table) {
			$table->id('id');
			$table->unsignedBigInteger('city_id');
			$table->unsignedBigInteger('client_id');
			$table->string('title');
			$table->text('address_line');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
