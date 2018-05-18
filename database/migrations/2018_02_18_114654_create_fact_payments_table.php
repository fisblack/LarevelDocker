<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
    
    /**
     * Class CreateFactPaymentsTable
     */
class CreateFactPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('fact_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_order_id');
            $table->text('value');
            $table->dateTime('date');
            $table->integer('bank_account_id');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fact_payments');
    }
}
