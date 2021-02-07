@extends('layouts.master')

@section('content')

<main class='register-page'>
    <div class="container">
        <h1> {{ __('lang.resetPassword') }} </h1>
        <div class='row'>
            <div class='col-lg-8 col-md-10 mx-auto'>
                <div class='register-box'>
                    <div class='row justify-content-center'>
                        <div class='col-md-6 order-md-0 order-1'>
                            <h2> {{ __('lang.resetPasswordHint') }} </h2>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class='form-group'>
                                    <input class='form-control {{ $errors->first('email') ? 'is-invalid' : '' }}'
                                        placeholder='{{ __('lang.email') }}' title='{{ __('lang.email') }}' name="email"
                                        value="{{ old('email') }}" type='email' required>
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-4">
                                        <button type="submit" class="btn">
                                            {{ __('lang.sendPasswordResetLink') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
