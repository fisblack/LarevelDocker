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
        $response = $this->call('GET', '/<project_name>');
        $this->assertEquals(200, $response->status());
    }
}
