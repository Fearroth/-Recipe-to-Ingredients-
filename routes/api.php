<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeApiController;
use App\Http\Resources\RecipeResource;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// }); // auto utworzone

Route::prefix('/recipes')->group(function () {
    Route::get('/', [RecipeApiController::class, 'index']);
    Route::get('/{model}', [RecipeApiController::class, 'show']);
    Route::post('/', [RecipeApiController::class, 'store']);
});
