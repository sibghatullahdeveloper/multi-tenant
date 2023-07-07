<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_conversion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('source_currency');
            $table->string('target_currency');
            $table->decimal('closing_rate');
            $table->decimal('average_rate')->nullable();
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
        Schema::dropIfExists('currency_conversion');
    }
}
