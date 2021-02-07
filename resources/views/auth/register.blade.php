@extends('layouts.master')

@section('content')

<main class='register-page'>
    <div class='container'>
		<div class='row'>
				<div class='col-auto mx-auto'>
					<div class='register-box'>
						<h1> {{ __('lang.startWithUsNow') }} </h1>

                        <h2> {{ __('lang.register_follower') }} </h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('name') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.name') }}' title='{{ __('lang.name') }}' name="name"
                                    value="{{ old('name') }}" type='name'>
                                @if ($errors->first('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('username') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.username') }}' title='{{ __('lang.username') }}' name="username"
                                    value="{{ old('username') }}" type='username'>
                                @if ($errors->first('username'))
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.phone') }}' title='{{ __('lang.phone') }}' name="phone"
                                    value="{{ old('phone') }}" type='text'>
                                @if ($errors->first('phone'))
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
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

                            <div class='form-group'>
                                <input
                                    class='form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.password_confirmation') }}'
                                    title='{{ __('lang.password_confirmation') }}' name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" type='password'>
                                @if ($errors->first('password_confirmation'))
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>

                            <button type="submit" class='btn'> {{ __('lang.register') }} </button>
                        </form>
						<div class='login-now'>
							<p>
                                {{ __('lang.footerText') }}
								<a href='#'> {{ __('lang.termsAndConditions') }} </a>
							   -
                                <a href='#'> {{ __('lang.privacyPolicy') }} </a>
							</p>
							<a href='{{ route('login') }}'>
                                {{ __('lang.hasUser') }}
                                {{ __('lang.login') }}
                            </a>
						</div>
					</div>
				</div>
			</div>
    </div>
</main>

@endsection
