<?php

namespace App\Services;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Enums\ComputersExcelEnum;
use App\Utils\Converter;
use Illuminate\Support\Facades\Validator;

class ComputerService
{
    protected $computersImport;

    public function __construct(ComputersImportInterface $computersImport)
    {
        $this->computersImport = $computersImport;
    }

    public function getComputers($filters)
    {
        $data = $this->computersImport->getAllData();

        if ($filters['location']) {
            $data = $data->where('location', $filters['location']);
        }
        
        if ($filters['ram']) {
            $data = $data->filter(function ($value) use ($filters) {
                $return = false;
                foreach ($filters['ram'] as $string) {
                    if (strpos($value['ram'], $string) !== false) {
                        $return = true;
                    }
                }
                return $return;
            });
        }

        if ($filters['min_storage'] && $filters['max_storage']) {
            $min = Converter::convertMemorySize($filters['min_storage']);
            $max = Converter::convertMemorySize($filters['max_storage']);

            $data = $data->filter(function ($value) use ($min, $max) {
                $validator = Validator::make(
                    ['value' => $value['storage']],
                    ['value' => "numeric|between:$min,$max"]
                );
                
                return !$validator->fails();
            });
        }

        if ($filters['harddisk']) {
            $data = $data->filter(function ($value) use ($filters) {
                $hdd = $filters['harddisk'];
                return preg_match("/{$hdd}/", $value['hdd']);
            });
        }

        return $data->values();
    }
}
