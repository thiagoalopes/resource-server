<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class OAuthIntrospectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = Http::withHeaders([
            "Authorization"=> "Bearer " . $request->bearerToken()
            ])
        ->get(env("BASE_URL_INTROSPECT_SERVER").'/oauth/token/introspection');
        
        if ($response->successful() && $response['access_token']) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }
}
