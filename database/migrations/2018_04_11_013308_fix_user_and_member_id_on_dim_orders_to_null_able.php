<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class FixUserAndMemberIdOnDimOrdersToNullAble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE dim_sale_orders CHANGE COLUMN user_id user_id INT(11) NULL');
        DB::statement('ALTER TABLE dim_sale_orders CHANGE COLUMN member_id member_id INT(11) NULL');

//        Schema::table('dim_sale_orders', function (Blueprint $table) {
//            $table->integer('user_id')->nullable()->change();
//            $table->integer('member_id')->nullable()->change();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE dim_sale_orders CHANGE COLUMN user_id user_id INT(11)');
        DB::statement('ALTER TABLE dim_sale_orders CHANGE COLUMN member_id member_id INT(11)');
//        Schema::table('dim_sale_orders', function (Blueprint $table) {
//            $table->integer('user_id')->change();
//            $table->integer('member_id')->change();
//        });
    }
}
