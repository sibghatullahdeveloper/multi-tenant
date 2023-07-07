<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_meta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            /**Foreign Key */
            $table->foreignUuid('product_id');
            $table->foreign('product_id')->references('id')->on('product');
            $table->longText('values');
            $table->string('feature');
            $table->string('slug');
            $table->string('quantity');
            $table->float('starting_price');
            $table->integer('reserved_quantity');
            $table->boolean('has_value_price')->default(true);
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
        Schema::dropIfExists('product_features');
    }
}
