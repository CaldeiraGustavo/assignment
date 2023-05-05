<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterControllerTest extends TestCase
{
    public function testShouldReturnStorages()
    {
        $response = $this->get('api/storages');
        $response->assertOk();
        $response->assertJsonFragment(['1TB']);
    }

    public function testShouldReturnRams()
    {
        $response = $this->get('api/rams');
        $response->assertOk();
        $response->assertJsonFragment(['4GB']);
    }

    public function testShouldReturnHardDisks()
    {
        $response = $this->get('api/hard-disks');
        $response->assertOk();
        $response->assertJsonFragment(['SSD']);
    }
}
