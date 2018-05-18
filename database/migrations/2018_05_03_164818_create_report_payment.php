<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_report_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_order_id')->unsigned();
            $table->integer('bank_acc')->unsigned();
            $table->string('payment_amount', 20);
            $table->string('slip_location', 200);
            $table->text('description')->nullable();
            $table->dateTime('report_timestamp');
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
        Schema::dropIfExists('dim_report_payments');
    }
}
