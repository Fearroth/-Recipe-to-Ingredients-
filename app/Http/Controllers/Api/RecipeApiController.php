<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ProductRecipe;
use Illuminate\Http\{
    Request,
    Response,
    JsonResponse,
};

use App\Consts\ApiResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    RecipeStoreRequest,
    RecipeUpdateRequest
};
use App\Http\Resources\RecipeResource;

use App\Models\Recipe;

class RecipeApiController extends Controller
{
    public function index(): JsonResponse
    {
        $query = Recipe::query()->with('products');

        return response()->json([
            ApiResources::RECIPES => RecipeResource::collection($query->paginate(15)),
        ], Response::HTTP_OK);
    }

    public function show(Recipe $model): JsonResponse
    {
        $model->load(RECIPE::RELATION_PRODUCTS);
        return response()->json([
            ApiResources::RECIPE => new RecipeResource($model)
        ], Response::HTTP_OK);
    }

    public function store(RecipeStoreRequest $request): JsonResponse
    {
        $recipe = Recipe::create([
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR_ID => $request->author_id,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);
        foreach ($request->products as $product) {
            $name = $product['name'];
            $quantity = $product['quantity'];
            $unit = $product['unit'];

            $product = Product::firstOrCreate([Product::NAME => $name]);

            $recipe->products()->attach($product->id, [ProductRecipe::QUANTITY => $quantity, ProductRecipe::UNIT => $unit]);
        }
        $recipe->load(Recipe::RELATION_PRODUCTS);
        return response()->json([
            ApiResources::RECIPE => new RecipeResource($recipe),
        ], Response::HTTP_CREATED);
    }
    public function update(RecipeUpdateRequest $request, Recipe $model)
    {
        $model->update([
            Recipe::TITLE => $request->title,
            Recipe::AUTHOR_ID => $request->authorId,
            Recipe::INSTRUCTIONS => $request->instructions,
        ]);

        return response()->json([
            ApiResources::RECIPE => new RecipeResource($model),
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(Recipe $model): JsonResponse
    {
        $model->delete();

        return response()->json([
            ApiResources::RECIPE => null
        ], Response::HTTP_ACCEPTED);
    }
}