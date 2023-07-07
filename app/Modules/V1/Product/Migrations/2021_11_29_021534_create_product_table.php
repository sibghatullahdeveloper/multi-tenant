<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug');
            $table->enum('type',['single','variable'])->default('single');
            $table->integer('total_quantity');
            $table->double('min_price')->nullable();
            $table->double('max_price')->nullable();
            $table->integer('reserved_quanity')->nullable();
            $table->integer('max_order_limit')->nullable();
            $table->double('rating')->default(0.00);
            $table->double('review_count')->default(0.00);
            
            /**Foreign Keys */
            
            $table->foreignUuid('category_id');
            $table->foreign('category_id')->references('id')->on('category');

            $table->foreignUuid('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('category');
            $table->boolean('has_value_price')->default(true);
            $table->longText('images_features')->nullable();
            $table->longText('features')->nullable();
            $table->longText('description');
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
        Schema::dropIfExists('product');
    }
}
