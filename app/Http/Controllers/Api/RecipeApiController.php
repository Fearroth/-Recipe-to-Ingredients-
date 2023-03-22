<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\RecipeResource;

class RecipeApiController extends Controller
{
    public function index(): JsonResponse
    {
        $recipes = Recipe::all();
    
        return response()->json(RecipeResource::collection($recipes));
    }

    public function show(int $id): JsonResponse
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            return response()->json(new RecipeResource($recipe));
        } else {
            return response()->json(['error' => 'Recipe not found'], 404);
        }
    }



public function store(Request $request): JsonResponse
{
    $request->validate([
        'title' => 'required|min:5',
        'author' => 'required',
        'ingredients' => 'required',
        'instructions' => 'required',
    ]);

    $recipe = new Recipe([
        'title' => $request->get('title'),
        'author' => $request->get('author'),
        'ingredients' => $request->get('ingredients'),
        'instructions' => $request->get('instructions'),
    ]);
  
    $recipe->save();
    
    return response()->json(new RecipeResource($recipe), 201);
}



}


// public function store(Request $request): JsonResponse
// {
//     $validatedData = $request->validate([
//         'title' => 'required|string',
//         'author' => 'required|string',
//         'ingredients' => 'required|string',
//         'instructions' => 'required|string',
//     ]);

//     $recipe = Recipe::create($validatedData);

//     return response()->json(new RecipeResource($recipe), 201);
// }

// inna proba
// public function store(Request $request): JsonResponse
// {
//     $request->validate([
//         'title' => 'required',
//         'author' => 'required',
//         'ingredients' => 'required',
//         'instructions' => 'required',
//     ]);

//     $recipe = new Recipe([
//         'title' => $request->get('title'),
//         'author' => $request->get('author'),
//         'ingredients' => $request->get('ingredients'),
//         'instructions' => $request->get('instructions'),
//     ]);

//     $recipe->save();

//     return response()->json(new Resource($recipe), 201);
// }