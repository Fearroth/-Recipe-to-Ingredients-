<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Http\Resources\RecipeResource;

use App\Models\Recipe;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipeApiController extends Controller
{
    public function all(): JsonResponse
    {
        $recipe = Recipe::all();

        return response()->json([
            'recipes' => RecipeResource::collection($recipe),
        ]);
    }
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
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR => $request->author,
            Recipe::INGREDIENTS => $request->ingredients,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);

        return response()->json(new RecipeResource($recipe), 201);
    }
    public function update(RecipeUpdateRequest $request, Recipe $model)
    {
        $model->update([
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR => $request->author,
            Recipe::INGREDIENTS => $request->ingredients,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);
        return response()->json(new RecipeResource($model), 200);
    }
    public function restore($id): JsonResponse
    {
        $recipe = Recipe::withTrashed()->findOrFail($id)->restore();


        return response()->json(['message' => 'Recipe restored successfully'], 200);
    }
    public function destroy(Recipe $model): JsonResponse
    {
        $model->delete();

        return response()->json(['message' => 'Recipe soft-deleted successfully'], 200);
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