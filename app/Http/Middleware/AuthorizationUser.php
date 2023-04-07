<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;



class AuthorizationUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();


        if ($user->is_admin || ($user->id === $request->route('model')->id)) {
            return ($next($request));
        }
        abort(401);
    }
}