<?php

use App\Http\Controllers\Api\ComputerController;
use App\Http\Controllers\Api\FilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/storages', [FilterController::class, 'getStorages']);
Route::get('/rams', [FilterController::class, 'getRams']);
Route::get('/hard-disks', [FilterController::class, 'getHardDisks']);
Route::get('/locations', [FilterController::class, 'getLocations']);
Route::get('/computers', [ComputerController::class, 'getComputers']);