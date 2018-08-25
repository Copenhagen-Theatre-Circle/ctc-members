<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Member
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
      $user = \Auth::user()->id;

      if ( User::find($user)->is_member )
        {
            return $next($request);
        }

      return redirect('nomember');

    }
}
