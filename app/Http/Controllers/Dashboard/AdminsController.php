<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Spatie\Permission\Models\Role;

use App\Admin;
use DB;


class AdminsController extends Controller
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
        'admins.username'   => [ 'like', request('username') ],
        'admins.email'   => [ 'like', request('email') ],
      ];

      $query = Admin::groupBy('id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $admins = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.admins.index', compact('admins'));
    }


    /**
     * Goto the form for creating a new admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('dashboard.admins.create', compact('roles'));
    }


    /**
     * Store a newly created admin.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->all());

        $admin->assignRole($request->roles);

        return redirect()->route('admin.admins.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admin $admin)
    {
        return view('dashboard.admins.show', compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();

      return view('dashboard.admins.edit', compact('admin', 'roles','adminRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {

        $admin->update($request->all());

        DB::table('model_has_roles')->where('model_id',$admin->id)->delete();

        $admin->assignRole($request->roles);

        return redirect()->route('admin.admins.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the admin
     */
    public function destroy(Admin $admin)
    {
        // Delete Record
        $admin->delete();

      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
