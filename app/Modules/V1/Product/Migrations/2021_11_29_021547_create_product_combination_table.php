<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCombinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_combination_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            /**Foreign Key */
            $table->foreignUuid('product_id');
            $table->foreign('product_id')->references('id')->on('product');
            $table->longText('combinations');
            $table->longText('product_images');
            $table->integer('created_by_id');
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_combination');
    }
}
