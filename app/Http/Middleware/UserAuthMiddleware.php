<?php

namespace App\Http\Middleware;

use Closure;

class UserAuthMiddleware
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
      if (!$request->session()->has('role')) {
         if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
         } else{
            return redirect()->route('login');
         }
      }
      return $next($request);
   }
}
