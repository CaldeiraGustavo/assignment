<?php
namespace App\Adapters\Contracts;

interface ComputersImportInterface
{
    public function getAllData();
    public function getStorages();
    public function getRams();
    public function getHdds();
    public function getLocations();
}
