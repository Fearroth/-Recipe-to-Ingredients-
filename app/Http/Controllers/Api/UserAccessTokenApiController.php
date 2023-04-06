<?php

namespace App\Http\Controllers\Api;

use App\Consts\ApiResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTokenRequest;
use App\Http\Resources\UserAccessTokenResource;

use App\Models\User;
use App\Models\UserAccessToken;

use Carbon\Carbon;

use Illuminate\Http\{
    Request,
    Response,
    JsonResponse,
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserAccessTokenApiController extends Controller
{
    public function login(UserTokenRequest $request): JsonResponse
    {
        $user = User::query()
            ->where(User::EMAIL, $request->email)
            ->first();

        if (!$user) {
            abort(401);
        }

        if (!Hash::check($request->password, $user->{User::PASSWORD})) {
            abort(401);
        }

        // Check for an user and password then check for token expiration
        UserAccessToken::query()
            ->where(UserAccessToken::USER_ID, $user->{User::ID})
            ->delete();

        $token = Str::random(60) . $user->{User::ID} . Carbon::now()->timestamp;

        $userAccessToken = UserAccessToken::create([
            UserAccessToken::USER_ID => $user->{User::ID},
            UserAccessToken::TOKEN => Hash::make($token),
            UserAccessToken::VALID_TO => Carbon::now()->addHours(72),
        ]);

        return response()->json([
            ApiResources::USER_ACCESS_TOKEN => new UserAccessTokenResource($userAccessToken),
        ], Response::HTTP_CREATED);
    }
}