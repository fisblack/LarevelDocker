<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDimShippingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dim_shipping_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
        });

        $data = [
            0 => ['name' => 'Registered'],
            1 => ['name' => 'EMS'],
            2 => ['name' => 'Kerry'],
        ];

        DB::table('dim_shipping_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_shipping_types');
    }
}
