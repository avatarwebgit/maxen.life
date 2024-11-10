<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMeasureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_measure', function (Blueprint $table) {
            $table->foreignId('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('measure_id');
            $table->foreign('measure_id')
                ->references('id')
                ->on('measures')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['category_id','measure_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_measure');
    }
}
