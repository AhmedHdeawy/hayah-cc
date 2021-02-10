<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\Center as ResourcesCenter;
use App\Http\Resources\City as ResourcesCity;
use App\Http\Resources\Governorate as ResourcesGovernorate;
use App\Models\Category;
use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;

class AppController extends Controller
{
    use JsonResponse;

    /**
     * Get All Categories
     *
     */
    public function categories(Request $request)
    {
        $categories =  ResourcesCategory::collection(Category::all());

        return $this->jsonResponse(200, 'Done', null, $categories);
    }


    /**
     * Get All Governorates
     *
     */
    public function governorates(Request $request)
    {
        $governorates =  ResourcesGovernorate::collection(Governorate::all());

        return $this->jsonResponse(200, 'Done', null, $governorates);
    }

    /**
     * Get All Cities
     *
     */
    public function cities(Request $request)
    {
        $cities =  ResourcesCity::collection(City::all());

        return $this->jsonResponse(200, 'Done', null, $cities);
    }


    /**
     * Get All Cities
     *
     */
    public function centers(Request $request)
    {
        $query = Center::latest();

        if ($request->has('category_id') && !empty($request->has('category_id'))) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('governorate_id') && !empty($request->has('governorate_id'))) {
            $query->where('governorate_id', $request->governorate_id);
        }

        if ($request->has('city_id') && !empty($request->has('city_id'))) {
            $query->where('city_id', $request->city_id);
        }

        $centers =  ResourcesCenter::collection($query->paginate());

        return $this->jsonResponse(200, 'Done', null, $centers);
    }


}
