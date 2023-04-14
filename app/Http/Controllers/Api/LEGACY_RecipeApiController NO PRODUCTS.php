<!-- <?php

// namespace App\Http\Controllers\Api;

// use Illuminate\Http\{
//     Request,
//     Response,
//     JsonResponse,
// };

// use App\Consts\ApiResources;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\{
//     RecipeStoreRequest,
//     RecipeUpdateRequest
// };
// use App\Http\Resources\RecipeResource;

// use App\Models\Recipe;

// class RecipeApiController extends Controller
// {
//     public function index(): JsonResponse
//     {
//         $query = Recipe::query();

//         return response()->json([
//             ApiResources::RECIPES => RecipeResource::collection($query->paginate(15)),
//         ], Response::HTTP_OK);
//     }

//     public function show(Recipe $model): JsonResponse
//     {
//         return response()->json([
//             ApiResources::RECIPE => new RecipeResource($model)
//         ], Response::HTTP_OK);
//     }

//     public function store(RecipeStoreRequest $request): JsonResponse
//     {
//         $recipe = Recipe::create([
//             Recipe::TITLE => $request->title,
//             Recipe::AUTHOR_ID => $request->authorId,
//             Recipe::INGREDIENTS => $request->ingredients,
//             Recipe::INSTRUCTIONS => $request->instructions,
//         ]);

//         return response()->json([
//             ApiResources::RECIPE => new RecipeResource($recipe),
//         ], Response::HTTP_CREATED);
//     }
//     public function update(RecipeUpdateRequest $request, Recipe $model)
//     {
//         $model->update([
//             Recipe::TITLE => $request->title,
//             Recipe::AUTHOR_ID => $request->authorId,
//             Recipe::INGREDIENTS => $request->ingredients,
//             Recipe::INSTRUCTIONS => $request->instructions,
//         ]);

//         return response()->json([
//             ApiResources::RECIPE => new RecipeResource($model),
//         ], Response::HTTP_ACCEPTED);
//     }

//     public function destroy(Recipe $model): JsonResponse
//     {
//         $model->delete();

//         return response()->json([
//             ApiResources::RECIPE => null
//         ], Response::HTTP_ACCEPTED);
//     }
// } 
