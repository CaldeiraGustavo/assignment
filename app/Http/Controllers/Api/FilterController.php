<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilterController extends Controller
{
    protected $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    /**
     * @OA\Get(
     *     path="/storages",
     *     description="List all the available storage to filter",
     *     summary="List all the available storage to filter",
     *     tags={"Filters"},
     *     @OA\Response(response=200, description="List all the available storage to filter", @OA\JsonContent()),
     *     @OA\Response(response=404, description="No content found", @OA\JsonContent(example={})),
     *     @OA\Response(response=500, description="Internal server error.", @OA\JsonContent(@OA\Examples(example="result", value={"message": "Example message"}, summary="Exception message"))),
     * )
     */
    public function getStorages()
    {
        $data = $this->filterService->getStorages();
        if(count($data) > 0) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/rams",
     *     description="List all the available ram sizes",
     *     summary="List all the available ram sizes",
     *     tags={"Filters"},
     *     @OA\Response(response=200, description="List all the available ram sizes", @OA\JsonContent()),
     *     @OA\Response(response=404, description="No content found", @OA\JsonContent(example={})),
     *     @OA\Response(response=500, description="Internal server error.", @OA\JsonContent(@OA\Examples(example="result", value={"message": "Example message"}, summary="Exception message"))),
     * )
     */
    public function getRams()
    {
        $data = $this->filterService->getRams();
        if(count($data) > 0) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/hard-disks",
     *     description="List all the available hard disks to filter",
     *     summary="List all the available hard disks to filter",
     *     tags={"Filters"},
     *     @OA\Response(response=200, description="List all the available hard disks to filter", @OA\JsonContent()),
     *     @OA\Response(response=404, description="No content found", @OA\JsonContent(example={})),
     *     @OA\Response(response=500, description="Internal server error.", @OA\JsonContent(@OA\Examples(example="result", value={"message": "Example message"}, summary="Exception message"))),
     * )
     */
    public function getHardDisks()
    {
        $data = $this->filterService->getHardDisks();
        if(count($data) > 0) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/locations",
     *     description="List all the available location to filter",
     *     summary="List all the available location to filter",
     *     tags={"Filters"},
     *     @OA\Response(response=200, description="List all the available location to filter", @OA\JsonContent()),
     *     @OA\Response(response=404, description="No content found", @OA\JsonContent(example={})),
     *     @OA\Response(response=500, description="Internal server error.", @OA\JsonContent(@OA\Examples(example="result", value={"message": "Example message"}, summary="Exception message"))),
     * )
     */
    public function getLocations()
    {
        $data = $this->filterService->getLocations();
        if(count($data) > 0) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
    }
    
}
