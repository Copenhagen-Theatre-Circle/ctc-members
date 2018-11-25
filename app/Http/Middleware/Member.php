<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Season;
use App\Settings;
use App\MembershipImporter;

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
        else {
            // import memberships
            $active_season_id = Settings::first()->active_season_id;
            $season = Season::where('id', $active_season_id )->first();
            $importer = new MembershipImporter($active_season_id);
            $import = $importer->importData();
            // check again if user is member, if not: go to nomember home page
            if ( User::find($user)->is_member){
                return $next($request);
            } else {
                return response()->view('nomember', Compact('season'));
            }
        }
    }
}
