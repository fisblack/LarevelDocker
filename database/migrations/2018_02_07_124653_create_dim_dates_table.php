<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('dim_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date');
            $table->string('day', 50);
            $table->integer('day_of_week');
            $table->integer('month');
            $table->string('month_name', 100);
            $table->integer('quarter');
            $table->string('quarter_name', 100);
            $table->integer('year');
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
        Schema::dropIfExists('dim_dates');
    }
}
