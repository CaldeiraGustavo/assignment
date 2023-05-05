<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ComputerService;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    protected $service;
    protected $filters;

    public function __construct(Request $request, ComputerService $service)
    {
        $this->service = $service;
        $this->filters = [
            'ram' => $request->get('ram') ?? null,
            'max_storage' => $request->get('max_storage') ?? null,
            'min_storage' => $request->get('min_storage') ?? null,
            'harddisk' => $request->get('harddisk') ?? null,
            'location' => $request->get('location') ?? null,
        ];
    }
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
     *        description="Filters the minimum value for the storage field",
     *        in="query",
     *        name="min_storage",
     *        example="1TB",
     *        @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *        description="Filters the maximum value for the storage field",
     *        in="query",
     *        name="max_storage",
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
        return $this->service->getComputers($this->filters);
    }
}
