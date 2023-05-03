<?php

namespace App\Http\Controllers;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Imports\ComputersExcelImport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @OA\Swagger(
 *     schemes={"http", "https"},
 *     @OA\Info(
 *          version="1.0.0",
 *          title="Documentation to Technical Assignment",
 *          description="Swagger to Technical Assignment",
 *          @OA\Contact(
 *              email="gustavo.caldeira1@outlook.com"
 *          ),
 *          @OA\License(
 *              name="Apache 2.0",
 *              url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *          )
 *     )
 * ),
 * 
 * @OA\Tag(
 *     name="Computers",
 *     description="Return all information about the computers"
 * )
 * 
 * @OA\Tag(
 *     name="Filters",
 *     description="Return all the available filters"
 * )
 * 
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
