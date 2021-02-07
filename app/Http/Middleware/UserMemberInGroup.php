<?php

namespace App\Http\Middleware;

use App\Models\Group;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserMemberInGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $group = Group::whereUniqueName($request->group_permlink)->first();
        if (!$group) { abort(404); }

        // check that this user owner the group or Member in it
        $usersInGroups = $group->users->pluck('pivot.user_id')->toArray();

        if (!in_array(Auth::id(), $usersInGroups)) {
            abort(403, __('lang.permissionDenied'));
        }

        return $next($request);

    }
}
