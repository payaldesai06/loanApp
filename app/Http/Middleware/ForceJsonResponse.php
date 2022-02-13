<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next) {
		$request->headers->set('Accept', 'application/json');
        // $request->headers->set('FLORAGRAM:IN', 'base64:g2gTiVAMlWtpYi46enR0xNLy2LAg6f/s7AlGLzz5HJY=');
		return $next($request);
	}
}
