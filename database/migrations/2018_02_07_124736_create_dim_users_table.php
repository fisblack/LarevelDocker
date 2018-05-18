<?php

use Baraear\ThaiAddress\Models\PostalCode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use SenseBook\Models\Address;
use SenseBook\Models\Date;
use SenseBook\User;

class CreateDimUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('dim_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('full_name');
            $table->string('phone');
            $table->integer('date_of_birth_id')->unsigned()->nullable();
            $table->integer('billing_address_id')->unsigned()->nullable();
            $table->integer('shipping_address_id')->unsigned()->nullable();
            $table->integer('user_class_id')->unsigned()->nullable();
            $table->text('image')->nullable();
            $table->enum('type', [
                'member',
                'admin'
            ])->default('member');
            $table->integer('points_balance')->default(0);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        User::query()->truncate();
        Address::query()->truncate();
        Date::query()->truncate();

        try {
            $member = new User();
            $member->email = 'info@adiwit.co.th';
            $member->password = bcrypt('88888888');
            $member->full_name = 'AdiwIT Co., Ltd.';
            $member->phone = '0000000000';
            $member->type = 'admin';

            $member->save();

            $datetime = new DateTime('2018-01-01');
            $dob = $member->dateOfBirth()->create([
                'date' => $datetime->format('d'),
                'day' => $datetime->format('l'),
                'day_of_week' => ((int)$datetime->format('w') + 1),
                'month' => $datetime->format('m'),
                'month_name' => $datetime->format('F'),
                'quarter' => ceil($datetime->format('m') / 3),
                'quarter_name' => '',
                'year' => $datetime->format('Y')
            ]);

            $postal_code = PostalCode::query()->find(129);

            $address = [
                'user_id' => $member->id,
                'address_line_1' => "18 อาคารกิจพานิช",
                'address_line_2' => "ถนนพัฒน์พงศ์",
                'sub_district_id' => $postal_code->sub_district->id,
                'district_id' => $postal_code->district->id,
                'province_id' => $postal_code->province->id,
                'postal_code_id' => $postal_code->id
            ];

            $billingAddress = $member->billingAddress()->create($address);
            $shippingAddress = $billingAddress;

            $member->update([
                'date_of_birth_id' => $dob->id,
                'billing_address_id' => $billingAddress->id,
                'shipping_address_id' => $shippingAddress->id
            ]);
        } catch (Exception $e) {
            //
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dim_users');
    }
}
