<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\GovernorateRequest;

class GovernoratesController extends Controller
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
        'governorate_translations.governorates_desc'   => [ 'like', request('desc') ],
        'governorates.governorates_status'              => [ '=', request('status') ]
      ];

      $query = Governorate::join('governorate_translations', 'governorates.id', 'governorate_translations.governorate_id')
                        ->groupBy('governorates.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $governorates = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.governorates.index', compact('governorates'));
    }


    /**
     * Goto the form for creating a new governorate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.governorates.create');
    }


    /**
     * Store a newly created governorate.
     *
     * @param  \App\Modules\Admin\Http\Requests\GovernorateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GovernorateRequest $request)
    {
        $governorate = Governorate::create($request->all());

        Cache::forget('governorates');

        return redirect()->route('admin.governorates.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Governorate $governorate)
    {
        $showLang = $request->showLang;
        return view('dashboard.governorates.show', compact('governorate', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $governorate)
    {
        return view('dashboard.governorates.edit', compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(GovernorateRequest $request, Governorate $governorate)
    {

        $governorate->update($request->all());

        Cache::forget('governorates');

        return redirect()->route('admin.governorates.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the governorate
     */
    public function destroy(Governorate $governorate)
    {
        // Delete Record
        $governorate->delete();

        Cache::forget('governorates');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
