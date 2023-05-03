<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComputerController extends Controller
{

    /**
     * @OA\Get(
     *     path="/computers",
     *     description="List all the computers according to filter",
     *     summary="List all the computers according to filter",
     *     tags={"Computers"},
     *     @OA\Parameter(
     *        description="Filter the RAM's",
     *        in="query",
     *        name="ram[]",
     *        example={"4GB", "64GB"},
     *        @OA\Schema(
     *           type="object"
     *        ),
     *     ),
     *     @OA\Parameter(
     *        description="Filter the storage size",
     *        in="query",
     *        name="storage",
     *        example="8TB",
     *        @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *        description="Filter the harddisk type",
     *        in="query",
     *        name="harddisk",
     *        example="SSD",
     *        @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *        description="Filter the Location",
     *        in="query",
     *        name="location",
     *        example="AmsterdamAMS-01",
     *        @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="List all the computers according to filter", @OA\JsonContent()),
     *     @OA\Response(response=404, description="No content found", @OA\JsonContent(example={})),
     *     @OA\Response(response=500, description="Internal server error.", @OA\JsonContent(@OA\Examples(example="result", value={"message": "Example message"}, summary="Exception message"))),
     * )
     */
    public function getComputers()
    {
        // return $this->filterService->getStorages();
    }
}
