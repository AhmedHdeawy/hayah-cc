<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Cache;

use App\Models\Country;


class CountriesController extends Controller
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
        'country_translations.countries_desc'   => [ 'like', request('desc') ],
        'countries.countries_status'              => [ '=', request('status') ]
      ];

      $query = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
                        ->groupBy('countries.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $countries = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.countries.index', compact('countries'));
    }


    /**
     * Goto the form for creating a new country.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.countries.create');
    }


    /**
     * Store a newly created country.
     *
     * @param  \App\Modules\Admin\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
       // dd($request->all());
        $country = Country::create($request->all());

        return redirect()->route('admin.countries.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Country $country)
    {
        $showLang = $request->showLang;
        return view('dashboard.countries.show', compact('country', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {

        return view('dashboard.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {

        $country->update($request->all());

        return redirect()->route('admin.countries.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the country
     */
    public function destroy(Country $country)
    {
        // Delete Record
        $country->delete();

        Cache::forget('countries');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
