<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CategoryRequest;
use App\Models\Department;

class CategoriesController extends Controller
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
        'category_translations.categories_desc'   => [ 'like', request('desc') ],
        'categories.categories_status'              => [ '=', request('status') ]
      ];

      $query = Category::join('category_translations', 'categories.id', 'category_translations.category_id')
                        ->groupBy('categories.id');

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $categories = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.categories.index', compact('categories'));
    }


    /**
     * Goto the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.categories.create');
    }


    /**
     * Store a newly created category.
     *
     * @param  \App\Modules\Admin\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        if ($request->has('image') && !empty($request->image)) {
            $this->saveImage($category, $request->image, 'image');
        }
        Cache::forget('categories');

        return redirect()->route('admin.categories.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        $showLang = $request->showLang;
        return view('dashboard.categories.show', compact('category', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        if ($request->has('image') && !empty($request->image)) {
            $this->saveImage($category, $request->image, 'image');
        }

        Cache::forget('categories');

        return redirect()->route('admin.categories.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the category
     */
    public function destroy(Category $category)
    {
        // Delete Record
        $category->delete();

        Cache::forget('categories');

        return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
