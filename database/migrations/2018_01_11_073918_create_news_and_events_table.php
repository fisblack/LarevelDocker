<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsAndEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('dim_news_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('category_news_events_id')->nullable();
            $table->longText('title_th');
            $table->longText('title_en');
            $table->longText('short_description_th');
            $table->longText('short_description_en');
            $table->longText('description_th');
            $table->longText('description_en');
            $table->text('image');
            $table->text('banner');
            $table->dateTime('news_events_date');
            $table->boolean('is_show')->default(true);
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
        Schema::dropIfExists('dim_news_events');
    }
}
