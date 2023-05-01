<?php
namespace App\Adapters\Contracts;

interface ComputersImportInterface
{
    public function getAllData();
    public function getModels();
    public function getRams();
    public function getHdds();
    public function getLocations();
    public function getPrices();
}
