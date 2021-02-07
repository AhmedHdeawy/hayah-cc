<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\Country;
use App\Models\State;
use Cache;


class StatesController extends Controller
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
            'state_translations.name'   => ['like', request('name')],
            'states.country_id'              => ['=', request('country')],
            'states.states_status'              => ['=', request('status')]
        ];

        $query = State::join('state_translations', 'states.id', 'state_translations.state_id')->groupBy('states.id');

        $searchQuery = $this->handleSearch($query, $inputsArray);

        $states = $searchQuery->paginate(config('my-config.perPage'));

        $countries = Cache::rememberForever('countries', function () {
            return Country::all();
        });

        return view('dashboard.states.index', compact('states', 'countries'));
    }


    /**
     * Goto the form for creating a new state.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Cache::rememberForever('countries', function () {
            return Country::all();
        });

        return view('dashboard.states.create', compact('countries'));
    }


    /**
     * Store a newly created state.
     *
     * @param  \App\Modules\Admin\Http\Requests\StateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {

        State::create($request->all());

        return redirect()->route('admin.states.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, State $state)
    {
        $showLang = $request->showLang;
        return view('dashboard.states.show', compact('state', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countries = Cache::rememberForever('countries', function () {
            return Country::all();
        });

        return view('dashboard.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $state->update($request->all());

        return redirect()->route('admin.states.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the state
     */
    public function destroy(State $state)
    {
        // Delete Record
        $state->delete();

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }
}
