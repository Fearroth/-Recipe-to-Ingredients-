<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

use App\Consts\HeaderKeys;
use App\Models\UserAccessToken;

class Auth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header(HeaderKeys::AUTHORIZATION)) {
            abort(401);
        }

        $userAccessToken = UserAccessToken::query()
            ->where(UserAccessToken::TOKEN, $request->header(HeaderKeys::AUTHORIZATION))
            ->where(UserAccessToken::VALID_TO, '>', Carbon::now())
            ->first();

        if (!$userAccessToken) {
            abort(401);
        }
        $request->setUserResolver(function () use ($userAccessToken) {
            return $userAccessToken->user;
        });

        return $next($request);
    }
}