<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testCaseExample()
    {
        $data = factory(User::class, 1)->make()->first()->toArray();
        
        $user = User::first();
        User::update($user->id, $data);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }
}
