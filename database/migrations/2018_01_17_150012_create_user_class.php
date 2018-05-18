<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_user_class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_th');
            $table->string('name_en');
            $table->string('color');
            $table->integer('discount');
            $table->enum('discount_type', ['Bath', '%']);
            $table->integer('minimum_purchase');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_user_class');
    }
}
