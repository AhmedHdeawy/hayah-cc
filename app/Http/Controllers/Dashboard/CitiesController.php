<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CityRequest;

class CitiesController extends Controller
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
        'city_translations.cities_desc'   => [ 'like', request('desc') ],
        'cities.cities_status'              => [ '=', request('status') ]
      ];

      $query = City::join('city_translations', 'cities.id', 'city_translations.city_id')
                        ->groupBy('cities.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $cities = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.cities.index', compact('cities'));
    }


    /**
     * Goto the form for creating a new city.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.cities.create');
    }


    /**
     * Store a newly created city.
     *
     * @param  \App\Modules\Admin\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->all());

        Cache::forget('cities');

        return redirect()->route('admin.cities.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, City $city)
    {
        $showLang = $request->showLang;
        return view('dashboard.cities.show', compact('city', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('dashboard.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {

        $city->update($request->all());

        Cache::forget('cities');

        return redirect()->route('admin.cities.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the city
     */
    public function destroy(City $city)
    {
        // Delete Record
        $city->delete();

        Cache::forget('cities');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
