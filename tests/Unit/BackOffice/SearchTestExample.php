<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleSearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchByName()
    {
        $data = [
            'name' => 'AdiwIT Co., Ltd.',
            'email' => 'info@adiwit.co.th',
        ];

        $user = User::create($data);

        $users = User::where('name', 'LIKE', '%#diw%')->get();

        $this->assertNotCount(0, $categories);
    }

    public function testSearchByDescription()
    {
        $data = [
            'name' => 'AdiwIT Co., Ltd.',
            'email' => 'info@adiwit.co.th',
        ];

        $user = User::create($data);

        $categories = User::where('description', 'LIKE', '%nfo%');

        $this->assertNotCount(0, $categories);
    }
}
