<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Category;
use App\Models\Center;
use App\Models\City;
use App\Models\Device;
use App\Models\Governorate;

class AuthController extends Controller
{
    use JsonResponse;

    /**
     * Get All Categories
     *
     */
    public function login(Request $request)
    {
        $request->validate([
            'card_id'   =>  'required',
            'device_id'   =>  'required',
            'device_token'   =>  'required',
        ]);

        $card = Card::find($request->card_id);

        if (!$card) {
            return $this->jsonResponse(404, __('lang.invalidCardId'), __('lang.invalidCardId'), null);
        }

        $device = Device::create([
            'device_id' =>  $request->device_id,
            'device_token' =>  $request->device_token,
        ]);

        $data = [
            'card'  =>  $card,
            'device'  =>  $device,
        ];

        return $this->jsonResponse(200, 'Done', null, $data);
    }


}
