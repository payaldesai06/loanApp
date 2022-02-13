<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class CheckUserMiddleware{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = JWTAuth::parseToken()->authenticate();
		if ($user) {
			if ($user && $user->role_id == 1) {
				return response()->json([
					'message' => 'You have no access to perform this action.',
					'code'      => 999,
                    'data' => (object)[]
				], 200);
			}
		}
		return $next($request);
	}
}
