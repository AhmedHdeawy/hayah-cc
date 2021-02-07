@extends('layouts.master')

@section('content')

<main class='register-page'>
    <div class="container">
        <h1> {{ __('lang.startWithUsNow') }} </h1>
        <div class='row'>
				<div class='col-auto mx-auto'>
					<div class='register-box'>
						<h1> {{ __('lang.login') }} </h1>

						<h2> {{ __('lang.registerHint') }} </h2>
						<form action="{{ route('login') }}" method="post">
                            @csrf

                            <input type="hidden" name="remember" value="1">

                            <div class='form-group'>
                                <select name="role" class='form-control {{ $errors->first('role') ? 'is-invalid' : '' }}'>
                                    <option value="1"> {{ __('lang.follower') }} </option>
                                    <option value="2"> {{ __('lang.subscriber') }} </option>
                                </select>
                                @if ($errors->first('role'))
                                <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('email') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.email') }}' title='{{ __('lang.email') }}' name="email"
                                    value="{{ old('email') }}" type='email'>
                                @if ($errors->first('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
							<div class='form-group'>
                                <input class='form-control {{ $errors->first('password') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.password') }}' title='{{ __('lang.password') }}'
                                    name="password" value="{{ old('password') }}" type='password'>
                                @if ($errors->first('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <button type="submit" class='btn'> {{ __('lang.login') }} </button>
						</form>

						<div class='login-now'>
							<a href='{{ route('password.request') }}'>
                                {{ __('lang.forgetPassword') }}
                            </a>
							<a href='{{ route('register') }}'>
                            {{ __('lang.hasNoUser') }}
                                {{ __('lang.register') }}
                            </a>
						</div>
					</div>
				</div>
			</div>
    </div>
</main>

@endsection
