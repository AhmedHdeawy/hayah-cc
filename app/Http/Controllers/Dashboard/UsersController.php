<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

use App\User;


class UsersController extends Controller
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
        'users.full_name'   => [ 'like', request('name') ],
        'users.phone'   => [ 'like', request('phone') ],
        'users.email'   => [ 'like', request('email') ],
        'users.status'              => [ '=', request('status') ]
      ];

      $query = User::latest();

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $users = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.users.index', compact('users'));
    }


    /**
     * Goto the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.users.create');
    }


    /**
     * Store a newly created user.
     *
     * @param  \App\Modules\Admin\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

       $request->merge([
          'username'  =>  mt_rand(1000000, mt_getrandmax())
        ]);

        $user = User::create($request->all());

        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('dashboard.users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the user
     */
    public function destroy(User $user)
    {
        // Get Image name
        $avatar = $user->avatar;

        // Delete Record
        $user->delete();

        // Delete Image
        $this->deleteFile('users/', $avatar);


      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
