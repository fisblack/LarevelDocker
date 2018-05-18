<?php

use Baraear\ThaiAddress\Models\PostalCode;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use SenseBook\Models\Address;
use SenseBook\Models\Date;
use SenseBook\Models\UserClass;
use SenseBook\User;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            0 => [
                'name_th' => 'ซิลเวอร์',
                'name_en' => 'Silver',
                'color' => '#B5B5B5',
                'discount_type' => '%',
                'discount' => 5,
                'minimum_purchase' => 1000,
            ],
            1 => [
                'name_th' => 'โกลด์',
                'name_en' => 'Gold',
                'color' => '#BD8900',
                'discount_type' => '%',
                'discount' => 10,
                'minimum_purchase' => 5000,
            ],
            2 => [
                'name_th' => 'แพตทินัท',
                'name_en' => 'Platinum',
                'color' => '#125CBB',
                'discount_type' => '%',
                'discount' => 20,
                'minimum_purchase' => 10000,
            ]
        ];

        foreach ($classes as $key => $class) {
            $user_class = new UserClass;
            $user_class->fill($class);
            $user_class->save();
        }

        $totalMembers = 50;

        for ($i = 0; $i < $totalMembers; $i++) {
            $faker = Faker::create();
            $member = new User();
            $member->email = $faker->username . $i . '@domain.com';
            $member->password = bcrypt('password');
            $member->full_name = $faker->name;
            $member->phone = $faker->tollFreePhoneNumber;
            $member->date_of_birth_id = $this->createDate();
            $member->billing_address_id = $this->createBillingAddress();
            $member->shipping_address_id = $this->createShippingAddress();
            $member->user_class_id = UserClass::all()->pluck('id')->random(1)->first();
            $member->image = "";
            $member->type = $faker->randomElement(['member', 'admin']);
            $member->points_balance = $faker->randomDigit;

            $member->save();

            $member->billingAddress()->update([
                'user_id' => $member->id
            ]);

            $member->shippingAddress()->update([
                'user_id' => $member->id
            ]);
        }
    }

    public function createDate()
    {
        $faker = Faker::create();
        $fake_date = $faker->dateTimeBetween('-30 years', 'now');
        $date = new Date;
        $date->date = $fake_date->format('d');
        $date->day = $fake_date->format('l');
        $date->day_of_week = ((int)$fake_date->format('w') + 1);
        $date->month = $fake_date->format('m');
        $date->month_name = $fake_date->format('F');
        $date->quarter = ceil($fake_date->format('m') / 3);
        $date->quarter_name = "";
        $date->year = $fake_date->format('Y');
        $date->save();

        return $date->id;
    }

    public function createBillingAddress()
    {
        $faker = Faker::create();
        $billing = new Address;
        $billing->address_line_1 = $faker->address;
        if (rand(0, 1)) {
            $billing->address_line_2 = $faker->secondaryAddress;
        }
        $postal_code_id = PostalCode::all()->random(1)->first()->id;
        $postal_code = PostalCode::query()->find($postal_code_id);
        $billing->sub_district_id = $postal_code->sub_district->id;
        $billing->district_id = $postal_code->district->id;
        $billing->province_id = $postal_code->province->id;
        $billing->postal_code_id = $postal_code->id;
        $billing->save();

        return $billing->id;
    }

    public function createShippingAddress()
    {
        $faker = Faker::create();
        $billing = new Address;
        $billing->address_line_1 = $faker->address;
        if (rand(0, 1)) {
            $billing->address_line_2 = $faker->secondaryAddress;
        }
        $postal_code_id = PostalCode::all()->random(1)->first()->id;
        $postal_code = PostalCode::query()->find($postal_code_id);
        $billing->sub_district_id = $postal_code->sub_district->id;
        $billing->district_id = $postal_code->district->id;
        $billing->province_id = $postal_code->province->id;
        $billing->postal_code_id = $postal_code->id;
        $billing->save();

        return $billing->id;
    }
}
