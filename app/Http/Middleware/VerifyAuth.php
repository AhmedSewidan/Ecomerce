<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([ 'message' => 'Token invalid'], 400);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([ 'message' => 'Token expired'], 400);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([ 'message' => 'Request don\'t have token'], 404);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'An unexpected error occurred in ' . __FILE__ . ' middleware: ' . $e->getMessage()], 404);
        }
        
        return $next($request);
    }
}
