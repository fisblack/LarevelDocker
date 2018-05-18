<?php
namespace SenseBook\Seeder\BackOffice\Setting\Point;

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('dim_points')->truncate();
        factory(\SenseBook\Models\Point::class, 10)->create();
    }
}
