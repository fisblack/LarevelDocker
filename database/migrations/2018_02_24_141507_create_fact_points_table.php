<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('fact_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->integer('points');
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
        Schema::dropIfExists('fact_points');
    }
}
