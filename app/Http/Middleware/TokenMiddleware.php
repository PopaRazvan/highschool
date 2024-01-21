<?php

namespace App\Http\Middleware;

use Closure;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {

        
        $token = session('access_token');
     

        if ($token) {
            
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        
         return $next($request);
        
    }
}
