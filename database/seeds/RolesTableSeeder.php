<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        fillPermissions();

        $role = Role::create([
            'name'  =>  'super_admin',
            'guard_name'    =>  'admin',
        ]);


        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $permission->assignRole($role);
        }


        foreach (Admin::all() as $admin) {
            $admin->assignRole($role);
        }

    }
}



function fillPermissions()
{
    $routes = Route::getRoutes();
    $excludedRoutes = config('permission.excluded_routes');

    foreach ($routes as $route) {
        $prefix = app()->getLocale() . '/admin';

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
}
