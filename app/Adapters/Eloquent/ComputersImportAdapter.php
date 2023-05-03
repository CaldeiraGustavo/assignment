<?php

namespace App\Adapters\Eloquent;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Imports\ComputersExcelImport;
use Exception;
use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ComputersImportAdapter.
 */
class ComputersImportAdapter implements ComputersImportInterface
{
    private $model = [
        'index' => 0,
        'data' => []
    ];
    private $ram = [
        'index' => 1,
        'data' => []
    ];
    private $hdd = [
        'index' => 2,
        'data' => []
    ];
    private $location = [
        'index' => 3,
        'data' => []
    ];
    private $price = [
        'index' => 4,
        'data' => []
    ];
    
    private $excelCollection;

    public function __construct()
    {
        $this->excelCollection =
            // Cache::rememberForever('excelCollection', function () {
                 Excel::toCollection(new ComputersExcelImport, storage_path('/excel/Excel_assignment.xlsx'));
            // });
        $this->initialize();
    }

    public function getAllData()
    {
        return $this->excelCollection;
    }

    public function initialize() : void
    {
        // if (!Cache::get('initialized')) {
            foreach($this->excelCollection[0] as $row) {
                // array_push($this->model['data'], $row[$this->model['index']]);
                // array_push($this->ram['data'], $row[$this->ram['index']]);
                // array_push($this->hdd['data'], $row[$this->hdd['index']]);
                array_push($this->location['data'], $row[$this->location['index']]);
                // array_push($this->price['data'], $row[$this->price['index']]);
            }
            // Cache::set('initialized', true);
        // }
    }

    public function getStorages()
    {
        // return Cache::rememberForever('model', function () {
            // return $this->model['data'];
            return [
                '0',
                '250GB',
                '500GB',
                '1TB',
                '2TB',
                '3TB',
                '4TB',
                '8TB',
                '12TB',
                '24TB',
                '48TB',
                '72TB',
            ];
        // });
    }

    public function getRams()
    {
        // return Cache::rememberForever('ram', function () {
            // return collect($this->ram['data']);
            return [
                '2GB',
                '4GB',
                '8GB',
                '16GB',
                '32GB',
                '64GB',
                '96GB',
            ];
        // });
    }

    public function getHdds()
    {
        // return Cache::rememberForever('hdd', function () {
            // return collect($this->hdd['data']);
            return [
                'SAS',
                'SATA',
                'SSD'
            ];
        // });
    }

    public function getLocations()
    {
        // return Cache::rememberForever('location', function () {
            return collect($this->location['data'])->unique()->values();
        // });
    }
}
