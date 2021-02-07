<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterSubscriberController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register-subscriber');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')],
            'phone' => ['required', 'string', 'max:40', Rule::unique('users', 'phone')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
            'youtube_channel' => ['required', 'string', 'url'],
            'instagram_channel' => ['required', 'string', 'url'],
            'channel_url' => ['nullable', 'url'],
            'country_id' => ['required', 'numeric', 'exists:countries,id'],
            'state_id' => ['required', 'numeric', 'exists:states,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => $data['password'],
                'youtube_channel' => $data['youtube_channel'],
                'instagram_channel' => $data['instagram_channel'],
                'channel_url' => isset($data['channel_url']) ? $data['channel_url'] : null,
                'country_id' => $data['country_id'],
                'state_id' => $data['state_id'],
        ]);

        $user->role = 2;
        $user->save();
        // Save QRCOde for username
        QrCode::size(20)->generate(
            route('subscriberProfile', ['username'    =>  $user->username]),
            storage_path('app/public/users/' .  $user->id . '.svg')
        );

        return $user;
    }
}
