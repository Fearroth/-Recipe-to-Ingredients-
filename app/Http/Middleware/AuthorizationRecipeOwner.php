<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

use App\Consts\HeaderKeys;
use App\Models\UserAccessToken;

class AuthorizationRecipeOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();


        if ($user->is_admin || ($user->id == $request->route('model')->author_id)) {
            return ($next($request));
        }
        return response()->json(['user' => $user->id, 'author_id' => $request->route('model')->author_id], 401);
    }
}