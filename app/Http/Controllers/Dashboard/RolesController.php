<?php

namespace App\Http\Controllers\Dashboard;

use Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $request->flash();

      $inputsArray = [
        'roles.name'   => [ 'like', request('name') ],
      ];

      $query = Role::groupBy('id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $roles = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.roles.index', compact('roles'));
    }


    /**
     * Goto the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('dashboard.roles.create', compact('permissions'));
    }


    /**
     * Store a newly created role.
     *
     * @param  \App\Modules\Admin\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin'
        ]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('dashboard.roles.show', compact('role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {

        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the role
     */
    public function destroy(Role $role)
    {

        // Delete Record
        $role->delete();

      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }



    public function permissions(Request $request)
    {
        $routes = Route::getRoutes();
        $excludedRoutes = config('permission.excluded_routes');

        foreach ($routes as $route) {
            $prefix = app()->getLocale().'/admin';

            if (strpos($route->getPrefix(), $prefix) !== false) {

                $name = $route->getName();

                // if this permission isn't exist in excluded permissions
                if (!in_array($name, $excludedRoutes)) {

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
                    $newName = $module . '.' . $page . '.' . $permission;

                    // get old permissions
                    $allPermissions = Permission::pluck('name')->toArray();

                    // check if not exist, then create it
                    if (!in_array($newName, $allPermissions)) {
                        Permission::create([
                            'name' => $newName,
                            'guard_name'    =>  'admin'
                        ]);
                    }

                }
            }
        }

        return redirect()->route('admin.roles.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }

}
