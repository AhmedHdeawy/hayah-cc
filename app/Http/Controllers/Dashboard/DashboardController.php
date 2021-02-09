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

        // $this->Cities($db);

        // dd($db['centers'][0]['branches']);


        dd("None");

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

            if (isset($item)) {

                $data = [
                    'category_id' => $item['category_id'] + 1,
                    'city_id' => $item['city_id'] < 0 ? abs($item['city_id']) : $item['city_id'] + 1,
                    'governorate_id' => $item['governorate_id'] < 0 ? abs($item['governorate_id']) : $item['governorate_id'] + 1,
                    'discount_value' => $item['discount_value'],
                    'hours' => isset($item['hours_en']) ? $item['hours_en'] : $item['hours'],
                    'latitude' => $item['latitude'] ?? null,
                    'longitude' => $item['longitude'] ?? null,
                    'logo' => $item['logo'],
                    'notes' => $item['notes'] ?? null,
                    'phone' => $item['phone'],
                    'ar' => [
                        'name' => isset($item['name_ar']) ? $item['name_ar'] : $item['name_en'],
                        'address' => $item['address'],
                        'coupon' => isset($item['coupon_ar']) ? $item['coupon_ar'] : null,
                    ],
                    'en' => [
                        'name' => isset($item['name_en']) ? $item['name_en'] : $item['name_en'],
                        'address' => isset($item['address_en']) ? $item['address_en'] : $item['address'],
                        'coupon' => isset($item['coupon_en']) ? $item['coupon_en'] : null,
                    ],
                ];

                $center = Center::create($data);

                if (isset($item['branches'])) {

                    $branches = array_unique($item['branches'], SORT_REGULAR);

                    foreach ($branches as $branch) {
                        $branchData = [
                            'category_id' => $branch['category_id'] + 1,
                            'city_id' => $branch['city_id'] < 0 ? abs($branch['city_id']) : $branch['city_id'] + 1,
                            'governorate_id' => $branch['governorate_id'] < 0 ? abs($branch['governorate_id']) : $branch['governorate_id'] + 1,
                            'discount_value' => $branch['discount_value'],
                            'hours' => $branch['hours_en'],
                            'latitude' => $branch['latitude'] ?? null,
                            'longitude' => $branch['longitude'] ?? null,
                            'logo' => $branch['logo'],
                            'notes' => isset($branch['notes']) ? $branch['notes'] : null,
                            'phone' => $branch['phone'],
                            'ar' => [
                                'name' => $branch['name_ar'],
                                'coupon' => isset($item['coupon_ar']) ? $item['coupon_ar'] : null,
                                'address' => $branch['address']
                            ],
                            'en' => [
                                'name' => $branch['name_en'],
                                'coupon' => isset($item['coupon_en']) ? $item['coupon_en'] : null,
                                'address' => isset($item['address_en']) ? $item['address_en'] : $item['address'],
                            ],
                        ];

                        $center->branches()->create($branchData);
                    }
                }
            }
        }
    }
}
