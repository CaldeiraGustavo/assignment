<?php

namespace App\Adapters\Eloquent;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Imports\ComputersExcelImport;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
            Cache::rememberForever('excelCollection', function () {
                return Excel::toCollection(new ComputersExcelImport, storage_path('/excel/Excel_assignment.xlsx'));
            });
        $this->initialize();
    }

    public function getAllData()
    {
        return $this->excelCollection;
    }

    public function initialize() : void
    {
        if (!Cache::get('initialized')) {
            foreach($this->excelCollection as $row) {
                $this->model['data'] = $row[$this->model['index']];
                $this->ram['data'] = $row[$this->ram['index']];
                $this->hdd['data'] = $row[$this->hdd['index']];
                $this->location['data'] = $row[$this->location['index']];
                $this->price['data'] = $row[$this->price['index']];
            }
            Cache::set('initialized', true);
        }
    }

    public function getModels() : Collection
    {
        return Cache::rememberForever('model', function () {
            return collect($this->model['data']);
        });
    }

    public function getRams() : Collection
    {
        return Cache::rememberForever('ram', function () {
            return collect($this->ram['data']);
        });
    }

    public function getHdds() : Collection
    {
        return Cache::rememberForever('hdd', function () {
            return collect($this->hdd['data']);
        });
    }

    public function getLocations() : Collection
    {
        return Cache::rememberForever('location', function () {
            return collect($this->location['data']);
        });
    }

    public function getPrices() : Collection
    {
        return Cache::rememberForever('price', function () {
            return collect($this->price['data']);
        });
    }
}
