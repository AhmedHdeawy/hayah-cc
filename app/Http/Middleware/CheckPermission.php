<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CheckPermission
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
        // dd(\App\Admin::with('roles')->with('permissions')->get());
        $user = Auth::guard('admin')->user();
        
        // $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
        $excludedRoutes = config('permission.excluded_routes');
        // get route name
        $name = $request->route()->getName();

        // this route exist in excluded routes
        if ( in_array($name, $excludedRoutes)  ) {
          return $next($request);
        }
        
        $routeArr = explode('.', $name);
        $module = $routeArr[0];     // admin
        $page = $routeArr[1];       // users
        $action = $routeArr[2];     // index

        switch (true) {
            case in_array($action, ['index', 'show']):
                $permission = 'view';
                break;
            
            case in_array($action, ['create', 'store']):
                $permission = 'create';
                break;
            
            case in_array($action, ['edit', 'update']):
                $permission = 'update';
                break;
            
            case in_array($action, ['destroy']):
                $permission = 'delete';
                break;
            
            default:
                $permission = $action;
                break;
        }

        // get full permission name
        $routeName = $module . '.' . $page . '.' . $permission;

        // check if this route availabe to this USER, OR, this route exist in excluded routes
        if ( Auth::guard('admin')->user()->can($routeName) || in_array($routeName, $excludedRoutes) ) {
        
          return $next($request);
        
        } else {

            abort(403, __('lang.permissionDenied'));
        }

        throw UnauthorizedException::forPermissions([$permission]);
        // if ( in_array($routeName, $userPermissions) || in_array($routeName, $excludedRoutes) ) {

    }
}
