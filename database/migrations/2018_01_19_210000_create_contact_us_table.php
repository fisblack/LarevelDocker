<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_contact_us', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title_th');
            $table->longText('title_en');
            $table->string('subtitle_th', 255);
            $table->string('subtitle_en', 255);
            $table->longText('description_th')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('address_th');
            $table->text('address_en');
            $table->string('email', 255);
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('phone', 20);
            $table->text('google_map')->nullable();
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
        Schema::dropIfExists('dim_contact_us');
    }
}
