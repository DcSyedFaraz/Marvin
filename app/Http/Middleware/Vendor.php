<?php

namespace App\Http\Middleware;

use Closure;

class Vendor
{

    public function handle($request, Closure $next)
    {
        $playerId = $request->route('id');

        // Check if the authenticated user can manage the player's profile.
        if (auth()->user()->canManagePlayerProfile($playerId)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
