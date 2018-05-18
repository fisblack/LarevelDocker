<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('dim_sale_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('member_id');
            $table->integer('document_date_id');
            $table->string('billing_address_line_1');
            $table->string('billing_address_line_2');
            $table->integer('billing_sub_district_id');
            $table->integer('billing_district_id');
            $table->integer('billing_province_id');
            $table->integer('billing_postcode_id');
            $table->string('shipping_address_line_1');
            $table->string('shipping_address_line_2');
            $table->integer('shipping_sub_district_id');
            $table->integer('shipping_district_id');
            $table->integer('shipping_province_id');
            $table->integer('shipping_postcode_id');
            $table->integer('delivery_date_id');
            $table->text('description')->nullable();
            $table->enum('status', ['unpaid','paid_unshipped','paid_shipping','paid_shipped']);
            $table->boolean('is_preorder')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->integer('shipping_method_id');
            $table->enum('payment_method', ['credit_card', 'money_transfer']);
            $table->integer('point_redemption_id')->nullable();
            $table->integer('point_accural_id')->nullable();
            $table->decimal('price_before_discount', 10, 3);
            $table->decimal('shipping_fee', 10, 3)->nullable();
            $table->decimal('discount', 10, 3)->nullable();
            $table->decimal('total_price', 10, 3);
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
        Schema::dropIfExists('dim_sale_orders');
    }
}
