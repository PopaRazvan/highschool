<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Closure;

class TokenVerificationMiddleware
{

    public function handle($request, Closure $next)
    {
        $token = session('access_token');

        $apiPath = Config::get('highschool-api.highschool_api_path');

        $response = Http::post($apiPath . '/auth/verify-token',['token' => $token]);

      

        if (!$token || !$response -> created()) {
            return redirect('/login')->with('message', '!');
        }

        return $next($request);
    }
}
