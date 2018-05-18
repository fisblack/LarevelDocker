<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Comment by @baraear : Disable this seed because I will create it by my seeder "MemberSeeder"
        // factory(\SenseBook\Models\UserClass::class, 20)->create();
        $this->call(\SenseBook\Seeder\BackOffice\Setting\Category\CategoryTableSeeder::class);
        $this->call(\SenseBook\Seeder\BackOffice\Setting\Point\PointsTableSeeder::class);
        $this->call(\SenseBook\Seeder\BackOffice\Promotion\PromotionsTableSeeder::class);
        $this->call(\SenseBook\Seeder\BackOffice\Promotion\PromotionVolumePurchaseTableSeeder::class);
        $this->call(\SenseBook\Seeder\BackOffice\Setting\Shipping\ShippingFeesTableSeeder::class);
        $this->call(\SenseBook\Seeder\BackOffice\Setting\Writer\WriterTableSeeder::class);
//        $this->call(ThaiAddressTablesSeeder::class);
        $this->call(MemberSeeder::class);
    }
}
