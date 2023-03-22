<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeStoreRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;

class RecipeApiController extends Controller
{
    public function index(): JsonResponse
    {
        $query = Recipe::query();

        return response()->json([
            'recipes' => RecipeResource::collection($query->paginate(15)),
        ]);
    }

    public function show(Recipe $model): JsonResponse
    {
        return response()->json(new RecipeResource($model));
    }

    public function store(RecipeStoreRequest $request): JsonResponse
    {
        $recipe = Recipe::create([
            'title' => $request->title,
            'author' => $request->author,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
        ]);

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