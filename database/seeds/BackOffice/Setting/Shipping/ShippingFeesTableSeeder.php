<?php
namespace SenseBook\Seeder\BackOffice\Setting\Shipping;

use Illuminate\Database\Seeder;

class ShippingFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('fact_shipping_fee')->truncate();
        factory(\SenseBook\Models\ShippingFee::class, 10)->create();
    }
}
