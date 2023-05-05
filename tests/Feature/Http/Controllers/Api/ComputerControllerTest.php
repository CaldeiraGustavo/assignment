<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComputerControllerTest extends TestCase
{
    
    public function testShouldReturnAllComputers(): void
    {
        $response = $this->get('/api/computers');
        $response->assertOk();
        $response->assertJsonStructure([
            "*" => [
                "model",
                "ram",
                "hdd",
                "location",
                "price",
            ]
        ]);
    }

    public function testShouldFilterLocation()
    {
        $response = $this->get('/api/computers?location=AmsterdamAMS-01');
        $response->assertOk();
        $response->assertJsonStructure([
            "*" => [
                "model",
                "ram",
                "hdd",
                "location",
                "price",
            ]
        ]);
        $response->assertJsonFragment(['location'=> 'AmsterdamAMS-01']);
    }

    public function testShouldFilterLocationAndHarddisk()
    {
        $response = $this->get('/api/computers?harddisk=SATA&location=AmsterdamAMS-01');
        $response->assertOk();
        $response->assertJsonStructure([
            "*" => [
                "model",
                "ram",
                "hdd",
                "location",
                "price",
            ]
        ]);
        $response->assertJsonFragment(['location'=> 'AmsterdamAMS-01']);
        $response->assertJsonFragment(['hdd'=> '2x2TBSATA2']);
    }

    public function testShouldFilterLocationHarddiskAndRam()
    {
        $response = $this->get('/api/computers?harddisk=SATA&location=AmsterdamAMS-01&ram[]=32GB&ram[]=16GB');
        $response->assertOk();
        $response->assertJsonStructure([
            "*" => [
                "model",
                "ram",
                "hdd",
                "location",
                "price",
            ]
        ]);
        $response->assertJsonFragment(['location'=> 'AmsterdamAMS-01']);
        $response->assertJsonFragment(['hdd'=> '2x2TBSATA2']);
        $response->assertJsonFragment(['ram'=> '16GBDDR3']);
    }

    public function testShouldFilterLocationHarddiskRamAndStorage()
    {
        $response = $this->get('/api/computers?harddisk=SATA&location=AmsterdamAMS-01&ram[]=32GB&ram[]=16GB&min_storage=1TB&max_storage=8TB');
        $response->assertOk();
        $response->assertJsonStructure([
            "*" => [
                "model",
                "ram",
                "hdd",
                "location",
                "price",
            ]
        ]);
        $response->assertJsonFragment(['location'=> 'AmsterdamAMS-01']);
        $response->assertJsonFragment(['hdd'=> '2x2TBSATA2']);
        $response->assertJsonFragment(['ram'=> '16GBDDR3']);
    }

    public function testShouldReturnNotFound()
    {
        $response = $this->get('/api/computers?harddisk=SSD&location=AmsterdamAMS-01&ram[]=32GB&ram[]=16GB&min_storage=1TB&max_storage=8TB');
        $response->assertNotFound();
        $response->assertJson([]);
    }
}
