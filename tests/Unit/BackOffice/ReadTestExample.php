<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleReadTest extends TestCase
{
    use RefreshDatabase;

    public function testCaseExample()
    {
        $user = User::first();
        
        $data = User::find($user->id);

        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->email, $data->email);
    }
}
