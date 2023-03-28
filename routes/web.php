<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//RecipesControllerone  line version
// Route::resource('recipes', RecipeController::class);


//RecipesController simplified version
// Route::prefix('/recipes')->group(function () {
//     Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
//     Route::get('/create', [RecipeController::class, 'create'])->name('recipes.create');
//     Route::post('/', [RecipeController::class, 'store'])->name('recipes.store');
//     Route::get('/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
//     Route::get('/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
//     Route::put('/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
//     Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
// });