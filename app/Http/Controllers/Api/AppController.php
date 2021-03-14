<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\City;
use App\Models\Center;
use App\Models\Device;
use App\Models\Category;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as ResourcesCity;
use App\Http\Resources\Center as ResourcesCenter;
use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\Governorate as ResourcesGovernorate;

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
        $query = Center::with(['city', 'category', 'governorate'])->latest();

        if ($request->has('category_id') && !empty($request->has('category_id'))) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('governorate_id') && !empty($request->has('governorate_id'))) {
            $query->where('governorate_id', $request->governorate_id);
        }

        if ($request->has('city_id') && !empty($request->has('city_id'))) {
            $query->where('city_id', $request->city_id);
        }

        $centers =  ResourcesCenter::collection($query->paginate()->sortBy('distance'));

        return $this->jsonResponse(200, 'Done', null, $centers);
    }
    
    
    /**
     * Get All Nearest Centers
     *
     */
    public function nearestCenters(Request $request)
    {

        // Initial Query
        $query = Center::with(['city', 'category', 'governorate'])->latest();

        // Search Discussion in 50KM
        if ($request->has(['latitude', 'longitude']) && $request->latitude != 0 && $request->longitude != 0) {

            $latitude = $request->latitude;
            $longitude = $request->longitude;

            $query = $query->select(
                DB::raw('
                *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distanceNearest
                ')
            )
                ->having('distanceNearest', '<', 5)
                ->orderBy('distanceNearest');
        }

        $centers =  ResourcesCenter::collection($query->get());

        return $this->jsonResponse(200, 'Done', null, $centers);
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'device_id'   =>  'required',
            'latitude'    =>  'required|numeric',
            'longitude'   =>  'required|numeric',
        ]);

        $device = Device::where('device_id', $request->device_id)->firstOrFail();

        $device->latitude = $request->latitude;
        $device->longitude = $request->longitude;
        $device->save();

        return $this->jsonResponse(200, 'Done', null, $device);
        
    }
}
