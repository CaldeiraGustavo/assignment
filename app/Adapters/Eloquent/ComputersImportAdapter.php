<?php

namespace App\Adapters\Eloquent;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Imports\ComputersExcelImport;
use App\Utils\Converter;
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
    private $locations = [];    
    private $excelCollection;

    public function __construct()
    {
        $this->excelCollection =
            // Cache::rememberForever('excelCollection', function () {
                 Excel::toCollection(new ComputersExcelImport, storage_path('/excel/Excel_assignment.xlsx'))[0];
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
            foreach($this->excelCollection as $row) {
                
                preg_match("/(\d+(?:\.\d+)?)\s*(?:TB|GB|MB|KB)/", $row['hdd'], $matches);
                $row['storage'] = Converter::convertMemorySize("{$matches[0]}");

                array_push($this->locations, $row['location']);
            }
            // Cache::set('initialized', true);
        // }
    }

    public function getStorages()
    {
        // return Cache::rememberForever('model', function () {
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
            return collect($this->locations)->unique()->values();
        // });
    }
}
