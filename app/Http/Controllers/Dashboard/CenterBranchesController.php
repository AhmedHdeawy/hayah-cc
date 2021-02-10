<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Center;
use App\Models\CenterBranch;
use App\Models\Category;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CenterBranchRequest;
use Illuminate\Support\Facades\Cache;

class CenterBranchesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $request->flash();

      $query = CenterBranch::join('center_branches_translations', 'center_branches.id', 'center_branches_translations.center_branch_id')
                        ->groupBy('center_branches.id')->latest();

      $searchQuery = $this->handleSearch($query, []);

      $centerBranches = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.center-branches.index', compact('centerBranches'));
    }


    /**
     * Goto the form for creating a new centerBranch.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        $cities = City::all();
        $categories = Category::all();
        $centers = Center::all();

      return view('dashboard.center-branches.create', compact('governorates', 'cities', 'categories', 'centers'));
    }


    /**
     * Store a newly created centerBranch.
     *
     * @param  \App\Modules\Admin\Http\Requests\CenterBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CenterBranchRequest $request)
    {
        $centerBranch = CenterBranch::create($request->all());

        if ($request->has('logo') && !empty($request->logo)) {
            $this->saveImage($centerBranch, $request->logo, 'logo');
        }

        Cache::forget('centerBranches');

        return redirect()->route('admin.center-branches.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CenterBranch  $centerBranch
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CenterBranch $centerBranch)
    {
        $showLang = $request->showLang;

        return view('dashboard.center-branches.show', compact('centerBranch', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(CenterBranch $centerBranch)
    {
        $governorates = Governorate::all();
        $cities = City::all();
        $categories = Category::all();
        $centers = Center::all();

        return view('dashboard.center-branches.edit', compact('centerBranch','governorates', 'cities', 'categories', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CenterBranchRequest $request, CenterBranch $centerBranch)
    {
        $centerBranch->update($request->all());

        if ($request->has('logo') && !empty($request->logo)) {
            $this->saveImage($centerBranch, $request->logo, 'logo');
        }

        Cache::forget('centerBranches');

        return redirect()->route('admin.center-branches.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the centerBranch
     */
    public function destroy(CenterBranch $centerBranch)
    {
        // Delete Record
        $centerBranch->delete();

        Cache::forget('centerBranches');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
