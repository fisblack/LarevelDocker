<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('general')) {
            Schema::create('general', function (Blueprint $table) {
                $table->increments('id');
                $table->text('maintenance_image');
                $table->text('close_image');
                $table->longText('maintenanace_cause')->nullable();
                $table->boolean('is_maintenance');
                $table->boolean('is_close');
                $table->text('order_image');
                $table->text('shipment_image');
                $table->text('return_image');
                $table->text('payment_image');
                $table->text('point_image');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general');
    }
}
