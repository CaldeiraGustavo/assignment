<?php

namespace App\Services;

use App\Adapters\Contracts\ComputersImportInterface;

class FilterService
{
    protected $computersImport;

    public function __construct(ComputersImportInterface $computersImport)
    {
        $this->computersImport = $computersImport;
    }
    
    
    public function getStorages()
    {
        return $this->computersImport->getModels();
    }

    public function getRams()
    {
        return $this->computersImport->getRams();
    }

    public function getHardDisks()
    {
        return $this->computersImport->getHdds();
    }

    public function getLocations()
    {
        return $this->computersImport->getLocations();
    }

}
