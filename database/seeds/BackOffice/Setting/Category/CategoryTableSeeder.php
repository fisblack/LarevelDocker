<?php
namespace SenseBook\Seeder\BackOffice\Setting\Category;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('dim_categories')->truncate();
        factory(\SenseBook\Models\Category::class, 10)->create();
    }
}
