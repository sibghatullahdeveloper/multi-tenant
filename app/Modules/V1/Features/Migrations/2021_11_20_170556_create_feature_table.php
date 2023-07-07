<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('display_type');
            // $table->foreignUuid('category_id');
            // $table->foreign('category_id')->references('id')->on('category');
            $table->longText('categories_id');
            $table->integer('sort_order');
            $table->string('description')->nullable();
            $table->string('icon_path')->nullable();
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
        Schema::dropIfExists('feature');
    }
}
