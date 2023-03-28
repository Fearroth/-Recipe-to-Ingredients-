<?php

namespace App\Http\Controllers\Api;


use App\Consts\RecipeApiControllerTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Http\Resources\RecipeResource;

use App\Models\Recipe;

use Illuminate\Http\JsonResponse;

class RecipeApiController extends Controller
{
    //RESOURCES
    public const RESOURCE_RECIPES = 'recipes';
    public const RESOURCE_MESSAGE = 'message';
    public const RESOURCE_MESSAGE_DELETE = 'Recipe soft-deleted successfully';
    public const RESOURCE_MESSAGE_RESTORE = 'Recipe restored successfully';
    public function all(): JsonResponse
    {
        $recipe = Recipe::all();

        return response()->json([
            RecipeApiControllerTypes::RESOURCE_RECIPES => RecipeResource::collection($recipe),
        ]);
    }
    public function index(): JsonResponse
    {
        $query = Recipe::query();

        return response()->json([
            RecipeApiControllerTypes::RESOURCE_RECIPES => RecipeResource::collection($query->paginate(15)),
        ]);
    }
    public function show(Recipe $model): JsonResponse
    {
        return response()->json([
            RecipeApiControllerTypes::RESOURCE_RECIPES => new RecipeResource($model)
        ]);
    }
    public function store(RecipeStoreRequest $request): JsonResponse
    {
        $recipe = Recipe::create([
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR => $request->author,
            Recipe::INGREDIENTS => $request->ingredients,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);

        return response()->json([
            RecipeApiControllerTypes::RESOURCE_RECIPES => new RecipeResource($recipe),
            201
        ]);
    }
    public function update(RecipeUpdateRequest $request, Recipe $model)
    {
        $model->update([
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR => $request->author,
            Recipe::INGREDIENTS => $request->ingredients,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);
        return response()->json([
            RecipeApiControllerTypes::RESOURCE_RECIPES => new RecipeResource($model),
            200
        ]);
    }
    public function restore(Recipe $model): JsonResponse
    {
        $model->restore();


        return response()->json([RecipeApiControllerTypes::RESOURCE_MESSAGE => RecipeApiControllerTypes::RESOURCE_MESSAGE_RESTORE], 200);
    }
    public function destroy(Recipe $model): JsonResponse
    {
        $model->delete();

        return response()->json([RecipeApiControllerTypes::RESOURCE_MESSAGE => RecipeApiControllerTypes::RESOURCE_MESSAGE_DELETE], 200);
    }

}