<?php

namespace ShareYourThoughts\Http\Middleware;

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
      if ($userType = !$request->session()->has('type')) {
         if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
         } else{
            return redirect()->route('getLogin');
         }
      }
      return $next($request);
   }
}
