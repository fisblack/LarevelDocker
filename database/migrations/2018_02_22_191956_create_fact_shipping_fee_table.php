<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactShippingFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_shipping_fee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->decimal('minimum_weight');
            $table->decimal('maximum_weight')->nullable();
            $table->decimal('amount');
            $table->integer('point_redemption');

            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('dim_shipping_types');
            $table->foreign('region_id')->references('id')->on('dim_shipping_regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fact_shipping_fee');
    }
}
