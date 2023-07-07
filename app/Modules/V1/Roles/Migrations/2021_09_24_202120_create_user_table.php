<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('role_id');
             /** 
             * 
             * Make Foreign Keys
             * 
             */

            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->longText('password');
            $table->enum('type',['user','pharmacy','admin'])->default('user');
            $table->float('lat');
            $table->string('verification_code')->nullable();
            $table->string('image_path')->nullable();
            $table->float('long');
            $table->string('phone_number');
            $table->longText('fcm_token')->nullable();
            $table->tinyInteger('is_whatsapp_available')->nullable();
            $table->integer('last_login')->nullable();
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
        Schema::dropIfExists('user');
    }
}
