<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeykPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peyk_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->nullable();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peyk_prices');
    }
}
