<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_about_us', function (Blueprint $table) {
            $table->increments('id');
            $table->text('image_head');
            $table->text('image_1');
            $table->text('image_2');
            $table->string('title', 255);
            $table->longText('head_description')->nullable();
            $table->longText('description_1')->nullable();
            $table->longText('description_2')->nullable();
            $table->longText('footer')->nullable();
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
        Schema::dropIfExists('dim_about_us');
    }
}
