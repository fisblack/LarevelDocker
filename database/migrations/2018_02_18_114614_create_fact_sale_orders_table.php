<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('fact_sale_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('sales_order_id');
            $table->integer('document_date_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price_per_unit');
            $table->integer('points_per_unit');
            $table->integer('amount');
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
        Schema::dropIfExists('fact_sale_orders');
    }
}
