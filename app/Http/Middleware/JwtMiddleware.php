<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user) {
                return response()->json([
                    'message'   => 'Session Expired - Please login again.',
                    'code'      => 999,
                    'data' => (object)[]
                ],200);
            }

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                 return response()->json([
                        'message'   => 'Session Expired - Please login again.',
                        'code'      => 999,
                        'data' => (object)[]
                    ],200);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                 return response()->json([
                    'message'   => 'Session Expired - Please login again.',
                    'code'      => 999,
                    'data' => (object)[]
                ],200);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                    return response()->json([
                        'message'   => 'The token has been blacklisted.',
                        'code'      => 999,
                        'data' => (object)[]
                    ],200);
            } else{
                 return response()->json([
                    'message'   => 'Authorization token not found.',
                    'code'      => 400,
                    'data' => (object)[]
                ],200);
            }
        }
        return $next($request);
    }
}
