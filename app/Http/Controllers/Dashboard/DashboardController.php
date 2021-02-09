<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Category;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Center;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db = json_decode(file_get_contents(database_path('hayah-care-export.json')), true);
dd("$db");
        foreach ($db['centers'] as $item) {
            if ($item['id'] != -1) {
                $data = [
                    'category_id' => $item['category_id'],
                    'city_id' => $item['city_id'],
                    'governorate_id' => $item['governorate_id'] + 1,
                    'discount_value' => $item['discount_value'],
                    'distance' => $item['distance'],
                    'hours' => $item['hours_en'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                    'logo' => $item['logo'],
                    'notes' => $item['notes'],
                    'phone' => $item['phone'],
                    'ar' => [
                        'name' => $item['name_ar'],
                        'coupon' => $item['coupon_ar'],
                        'address' => $item['address']
                    ],
                    'en' => [
                        'name' => $item['name_en'],
                        'coupon' => $item['coupon_en'],
                        'address' => $item['address_en'],
                    ],
                ];
                $center = Center::create($data);
                foreach ($$item['branches'] as $branche) {
                    $branche = [
                        'category_id' => $item['category_id'],
                        'city_id' => $item['city_id'],
                        'governorate_id' => $item['governorate_id'] + 1,
                        'discount_value' => $item['discount_value'],
                        'hours' => $item['hours_en'],
                        'latitude' => $item['latitude'],
                        'longitude' => $item['longitude'],
                        'logo' => $item['logo'],
                        'notes' => $item['notes'],
                        'phone' => $item['phone'],
                        'ar' => [
                            'name' => $item['name_ar'],
                            'coupon' => $item['coupon_ar'],
                            'address' => $item['address']
                        ],
                        'en' => [
                            'name' => $item['name_en'],
                            'coupon' => $item['coupon_en'],
                            'address' => $item['address_en'],
                        ],
                    ];
                }
            }
        }

        return view('dashboard.dashboard.home');
    }

    public function Cities($db)
    {
        foreach ($db['cities'] as $item) {
            if ($item['id'] != -1) {
                $data = [
                    'governorate_id' => $item['governorate_id'] + 1,
                    'ar' => [
                        'name' => $item['name_ar']
                    ],
                    'en' => [
                        'name' => $item['name_en']
                    ],
                ];
                City::create($data);
            }
        }
    }

    public function Governorate($db)
    {
        foreach ($db['Governorates'] as $item) {
            if ($item['id'] != -1) {
                $data = [
                    'ar' => [
                        'name' => $item['name_ar']
                    ],
                    'en' => [
                        'name' => $item['name_en']
                    ],
                ];
                Governorate::create($data);
            }
        }
    }

    public function Categories($db)
    {
        for ($i = 1; $i < count($db['categories']) - 1; $i++) {
            $category = $db['categories'][$i];
            $data = [
                'id' => $category['id'],
                'image' => $category['icon_url'],
                'ar' => [
                    'name' => $category['name_ar']
                ],
                'en' => [
                    'name' => $category['name_en']
                ],
            ];
            Category::create($data);
        }
    }


    public function Centers($db)
    {
        foreach ($db['centers'] as $item) {
            if ($item['id'] != -1) {
                $data = [
                    'category_id' => $item['category_id'],
                    'city_id' => $item['city_id'],
                    'governorate_id' => $item['governorate_id'] + 1,
                    'discount_value' => $item['discount_value'],
                    'distance' => $item['distance'],
                    'hours' => $item['hours_en'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                    'logo' => $item['logo'],
                    'notes' => $item['notes'],
                    'phone' => $item['phone'],
                    'ar' => [
                        'name' => $item['name_ar'],
                        'coupon' => $item['coupon_ar'],
                        'address' => $item['address']
                    ],
                    'en' => [
                        'name' => $item['name_en'],
                        'coupon' => $item['coupon_en'],
                        'address' => $item['address_en'],
                    ],
                ];
                $center = Center::create($data);
                foreach ($$item['branches'] as $branche) {
                    $branche = [
                        'category_id' => $item['category_id'],
                        'city_id' => $item['city_id'],
                        'governorate_id' => $item['governorate_id'] + 1,
                        'discount_value' => $item['discount_value'],
                        'hours' => $item['hours_en'],
                        'latitude' => $item['latitude'],
                        'longitude' => $item['longitude'],
                        'logo' => $item['logo'],
                        'notes' => $item['notes'],
                        'phone' => $item['phone'],
                        'ar' => [
                            'name' => $item['name_ar'],
                            'coupon' => $item['coupon_ar'],
                            'address' => $item['address']
                        ],
                        'en' => [
                            'name' => $item['name_en'],
                            'coupon' => $item['coupon_en'],
                            'address' => $item['address_en'],
                        ],
                    ];
                }
            }
        }
    }

}
