<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->decimal('birthday_discount', 10, 3);
            $table->enum('birthday_discount_unit', ['thb', 'percent']);
            $table->decimal('birthday_month_discount', 10, 3);
            $table->enum('birthday_month_discount_unit', ['thb', 'percent']);
            $table->decimal('second_tuesday_discount', 10, 3);
            $table->enum('second_tuesday_discount_unit', ['thb', 'percent']);
            $table->integer('free_shipping_amount_condition');
            $table->integer('free_shipping_weight_condition');
            $table->enum('free_shipping_benefit_type', ['kerry', 'registered', 'ems']);
            $table->date('double_point_start_date');
            $table->date('double_point_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
