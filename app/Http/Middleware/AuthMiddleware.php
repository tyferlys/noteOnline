<?php

namespace App\Http\Middleware;

use App\JWTToken\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie("token");

        if (!isset($token))
            return redirect()->route("login.index");

        $checking = JWTToken::checkToken($token);

        if ($checking === "notFound")
            return redirect()->route("login.index");

        $request->merge([
            "login" => $checking,
        ]);

        return $next($request);
    }
}
