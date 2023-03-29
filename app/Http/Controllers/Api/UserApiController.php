<?php

namespace App\Http\Controllers\Api;

use App\Consts\UserApiControllerTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTokenRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserAccessTokenResource;

use App\Models\User;
use App\Models\UserAccessToken;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserApiController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::paginate(15);
        return response()->json(
            [UserApiControllerTypes::RESOURCE_USER => UserResource::collection($users)]
        );
    }
    public function show(User $model): JsonResponse
    {
        return response()->json(
            [UserApiControllerTypes::RESOURCE_USER => new UserResource($model)]
        );
    }
    public function all(): JsonResponse
    {
        $user = User::all();

        return response()->json([
            UserApiControllerTypes::RESOURCE_USER => UserResource::collection($user),
        ]);
    }
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = User::create([
            User::NAME => $request->{User::NAME},
            User::EMAIL => $request->{User::EMAIL},
            User::PASSWORD => Hash::make($request->{User::PASSWORD})
        ]);

        return response()->json(
            [
                UserApiControllerTypes::RESOURCE_USER => new UserResource($user),
                201
            ]
        );
    }
    public function update(UserUpdateRequest $request, User $model): JsonResponse
    {
        $model->update([
            User::NAME => $request->{User::NAME},
            User::EMAIL => $request->{User::EMAIL},
            User::PASSWORD => Hash::make($request->{User::PASSWORD}),
        ]);

        return response()->json([
            UserApiControllerTypes::RESOURCE_USER => new UserResource($model)
        ]);
    }
    public function restore(User $model): JsonResponse
    {
        $model->restore();


        return response()->json(
            [UserApiControllerTypes::RESOURCE_MESSAGE => UserApiControllerTypes::RESOURCE_MESSAGE_RESTORE],
            200
        );
    }
    public function destroy(User $model): JsonResponse
    {
        $model->delete();
        return response()->json(
            [UserApiControllerTypes::RESOURCE_MESSAGE => UserApiControllerTypes::RESOURCE_MESSAGE_DELETE],
            200
        );
    }
    public function token(UserTokenRequest $request): JsonResponse
    {
        // $user = User::findOrFail($request->email); why not working???
        if (!$user = User::where(User::EMAIL, $request->{User::EMAIL})->first()) {
            abort(401);
        }
        ;
        // Check for an user and password then check for token expiration
        if ($user && Hash::check($request->{User::PASSWORD}, $user->{User::PASSWORD})) {
            //to many ifs cancel for now
            // $accessTokenValidTo = $user->useraccesstoken->last()->valid_to;
            // if (Carbon::parse($accessTokenValidTo) > Carbon::now()) {
            //     abort(401);
            // }
            // ;
            $token = Str::random(60) . $user->{User::EMAIL} . Carbon::now()->timestamp;
            $userAccessToken = UserAccessToken::create([
                UserAccessToken::USER_ID => $user->id,
                UserAccessToken::TOKEN => Hash::make($token),
                UserAccessToken::VALID_TO => Carbon::now()->addHours(2),
            ]);
            return response()->json([
                UserApiControllerTypes::RESOURCE_MESSAGE => UserApiControllerTypes::RESOURCE_MESSAGE_TOKEN_CREATE,
                UserApiControllerTypes::RESOURCE_TOKEN => new UserAccessTokenResource($userAccessToken),
            ], 201);
        } else {
            // can be abort(401)
            return response()->json(
                [UserApiControllerTypes::RESOURCE_ERROR => UserApiControllerTypes::RESOURCE_MESSAGE_ERROR_LOGIN],
                401
            );
        }
        ;
    }
}