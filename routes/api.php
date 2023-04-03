<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    RecipeApiController,
    UserApiController,
    UserAccessTokenApiController
};


use App\Http\Middleware\Auth;


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

//Routes for Recipe model
Route::middleware([Auth::class])->group(function () {
    Route::prefix('/recipes')->group(function () {
        Route::get('/', [RecipeApiController::class, 'index']);
        Route::post('/', [RecipeApiController::class, 'store']);
        Route::get('/{model}', [RecipeApiController::class, 'show']);
        Route::put('/{model}', [RecipeApiController::class, 'update']);
        Route::delete('/{model}', [RecipeApiController::class, 'destroy']);
    });
});

// Routes for User model
Route::prefix('/users')->group(function () {
    Route::get('/', [UserApiController::class, 'index']);
    Route::post('/', [UserApiController::class, 'store']);
    Route::get('/{model}', [UserApiController::class, 'show']);
    Route::put('/{model}', [UserApiController::class, 'update']);
    Route::delete('/{model}', [UserApiController::class, 'destroy']);
});

Route::prefix('/user-access-tokens')->group(function () {
    Route::post('/', [UserAccessTokenApiController::class, 'login']);
});