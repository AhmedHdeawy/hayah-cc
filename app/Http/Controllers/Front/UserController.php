<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function savedProperties()
    {
        $favorites = Auth::user()->favorites;

        return view('front.savedProperties', compact('favorites'));
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function subscriberProfile($username)
    {
        $user = User::where('username', $username)->where('role', 2)->firstOrFail();

        return view('front.subscriber', compact('user'));
    }


    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userProfile($username)
    {
        $user = User::where('username', $username)->where('role', 1)->firstOrFail();

        return view('front.profile', compact('user'));
    }


    /**
     * Post the ContactUs Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        // Validate Form
        $this->validateUserData($request);

        // Create New Row
        User::update($request->all());

        return redirect()->route('contactus')->with('status', __('lang.contactUsDone'));
    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateUserData(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|string',
        ])->validate();
    }
}
