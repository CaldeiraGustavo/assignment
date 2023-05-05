<?php

namespace Tests\Unit\Http\Requests\Api;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Http\Requests\Api\GetComputersRequest;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GetComputersRequestTest extends TestCase
{
    private $request;
    private $adapter;

    public function setUp(): void
    {
        parent::setUp();
        $this->adapter = App::make(ComputersImportInterface::class);
        $this->request = new GetComputersRequest($this->adapter);
    }
    
    public function testDeveriaConterTodasRegrasEsperadas()
    {
        $expect = [
            'ram' => ['nullable', 'array'],
            'ram.*' => ['required',  Rule::in($this->adapter->getRams())],
            'max_storage' => ['required_with:min_storage', Rule::in($this->adapter->getStorages())],
            'min_storage' => ['required_with:max_storage', Rule::in($this->adapter->getStorages())],
            'harddisk' => ['nullable', Rule::in($this->adapter->getHdds())],
            'location' => ['nullable', Rule::in($this->adapter->getLocations())],
        ];

        $this->assertEquals($expect, $this->request->rules());
    }

    public function testDeveriaAceitarDadosValidos()
    {

        $dadosValidos = [
            'ram' => ['4GB', '64GB'],
            'min_storage' => '1TB',
            'max_storage' => '8TB',
            'harddisk' => 'SSD',
            'location' => 'AmsterdamAMS-01',
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue(!$validator->fails());
    }

    public function testDeveriaEstarAutorizado()
    {
        $this->assertEquals(true, $this->request->authorize());
    }

    /**
     * @dataProvider proverDadosInvalidos
     */
    public function testDadosInvalidados(array $data)
    {
        $validador = Validator::make($data, $this->request->rules());
        $this->assertTrue($validador->fails());
    }

    public function proverDadosInvalidos(): array
    {
        return [
            [[//invalid ram
                'ram' => ['4FB', '64GB'],
                'min_storage' => '1TB',
                'max_storage' => '8TB',
                'harddisk' => 'SSD',
                'location' => 'AmsterdamAMS-01',
            ]],
            [[// invalid min storage
                'ram' => ['4GB', '64GB'],
                'min_storage' => '1LB',
                'max_storage' => '8TB',
                'harddisk' => 'SSD',
                'location' => 'AmsterdamAMS-01',
            ]],
            [[//invalid max storage
                'ram' => ['4GB', '64GB'],
                'min_storage' => '1TB',
                'max_storage' => '8ATB',
                'harddisk' => 'SSD',
                'location' => 'AmsterdamAMS-01',
            ]],
            [[//invalid location
                'ram' => ['4GB', '64GB'],
                'min_storage' => '1TB',
                'max_storage' => '8TB',
                'harddisk' => 'SSD',
                'location' => 'invalid_location',
            ]],
            [[//invalid harddisk
                'ram' => ['4FB', '64GB'],
                'min_storage' => '1TB',
                'max_storage' => '8TB',
                'harddisk' => 'ABCD',
                'location' => 'AmsterdamAMS-01',
            ]],
            [[//just min storage
                'ram' => ['4GB', '64GB'],
                'min_storage' => '1TB',
                'harddisk' => 'SSD',
                'location' => 'AmsterdamAMS-01',
            ]],
            [[// just max storage
                'ram' => ['4GB', '64GB'],
                'max_storage' => '8TB',
                'harddisk' => 'SSD',
                'location' => 'AmsterdamAMS-01',
            ]]
        ];
    }
}
