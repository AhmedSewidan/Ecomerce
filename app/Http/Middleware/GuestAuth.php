<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class GuestAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            if( JWTAuth::parseToken()->authenticate() ){
                return response()->json(['message' => 'Error you are logged in'], Response::HTTP_FORBIDDEN);
            }
        }  catch (\Exception $e) {}

        return $next($request);
    }
}
