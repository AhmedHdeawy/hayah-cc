<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Center;
use App\Models\Category;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CenterRequest;
use Illuminate\Support\Facades\Cache;

class CentersController extends Controller
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
        'center_translations.centers_desc'   => [ 'like', request('desc') ],
        'centers.centers_status'              => [ '=', request('status') ]
      ];

      $query = Center::join('center_translations', 'centers.id', 'center_translations.center_id')
                        ->groupBy('centers.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $centers = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.centers.index', compact('centers'));
    }


    /**
     * Goto the form for creating a new center.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        $cities = City::all();
        $categories = Category::all();

      return view('dashboard.centers.create', compact('governorates', 'cities', 'categories'));
    }


    /**
     * Store a newly created center.
     *
     * @param  \App\Modules\Admin\Http\Requests\CenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CenterRequest $request)
    {
        $center = Center::create($request->all());

        if ($request->has('logo') && !empty($request->logo)) {
            $this->saveImage($center, $request->logo, 'logo');
        }

        Cache::forget('centers');

        return redirect()->route('admin.centers.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Center $center)
    {
        $showLang = $request->showLang;
        return view('dashboard.centers.show', compact('center', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {
        $governorates = Governorate::all();
        $cities = City::all();
        $categories = Category::all();

        return view('dashboard.centers.edit', compact('center','governorates', 'cities', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CenterRequest $request, Center $center)
    {
        $center->update($request->all());

        if ($request->has('logo') && !empty($request->logo)) {
            $this->saveImage($center, $request->logo, 'logo');
        }

        Cache::forget('centers');
        return redirect()->route('admin.centers.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the center
     */
    public function destroy(Center $center)
    {
        // Delete Record
        $center->delete();

        Cache::forget('centers');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
