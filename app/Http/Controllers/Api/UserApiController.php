<?php

namespace App\Http\Controllers\Api;

use App\Consts\ApiResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;

use App\Models\User;

use Illuminate\Http\{
    Request,
    Response,
    JsonResponse,
};
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::paginate(15);
        return response()->json(
            [
                ApiResources::USER => UserResource::collection($users)
            ], Response::HTTP_OK
        );
    }
    public function show(User $model): JsonResponse
    {
        return response()->json(
            [
                ApiResources::USER => new UserResource($model)
            ], Response::HTTP_OK
        );
    }
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = User::create([
            User::NAME => $request->name,
            User::EMAIL => $request->user,
            User::PASSWORD => Hash::make($request->password)
        ]);

        return response()->json(
            [
                ApiResources::USER => new UserResource($user),

            ], Response::HTTP_CREATED
        );
    }
    public function update(UserUpdateRequest $request, User $model): JsonResponse
    {
        $model->update([
            User::NAME => $request->name,
            User::EMAIL => $request->user,
            User::PASSWORD => Hash::make($request->password),
        ]);

        return response()->json([
            ApiResources::USER => new UserResource($model)
        ], Response::HTTP_ACCEPTED);
    }
    public function destroy(User $model): JsonResponse
    {
        $model->delete();
        return response()->json(
            [ApiResources::USER => null],
            Response::HTTP_ACCEPTED
        );
    }
}