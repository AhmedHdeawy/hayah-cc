@extends('layouts.master')

@section('content')

<main class='register-page'>
    <div class='container'>
		<div class='row'>
				<div class='col-auto mx-auto'>
					<div class='register-box'>
						<h1> {{ __('lang.startWithUsNow') }} </h1>
                        <h2> {{ __('lang.register_subscriber') }} </h2>
                        <form action="{{ route('register-subscriber') }}" method="post">
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
                                <input class='form-control {{ $errors->first('youtube_channel') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.youtube_channel') }}' title='{{ __('lang.youtube_channel') }}' name="youtube_channel"
                                    value="{{ old('youtube_channel') }}" type='url'>
                                @if ($errors->first('youtube_channel'))
                                <div class="invalid-feedback">{{ $errors->first('youtube_channel') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('instagram_channel') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.instagram_channel') }}' title='{{ __('lang.instagram_channel') }}' name="instagram_channel"
                                    value="{{ old('instagram_channel') }}" type='url'>
                                @if ($errors->first('instagram_channel'))
                                <div class="invalid-feedback">{{ $errors->first('instagram_channel') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <input class='form-control {{ $errors->first('channel_url') ? 'is-invalid' : '' }}'
                                    placeholder='{{ __('lang.channel_url') }}' title='{{ __('lang.channel_url') }}' name="channel_url"
                                    value="{{ old('channel_url') }}" type='url'>
                                @if ($errors->first('channel_url'))
                                <div class="invalid-feedback">{{ $errors->first('channel_url') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <select id="countries" name="country_id" class='form-control {{ $errors->first('country_id') ? 'is-invalid' : '' }}'>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->first('country_id'))
                                <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                                @endif
                            </div>

                            <div class='form-group'>
                                <select id="states" name="state_id" class='form-control {{ $errors->first('state_id') ? 'is-invalid' : '' }}'>
                                    @foreach ($countries->first()->states as $state)
                                        <option value="{{ $state->id }}"> {{ $state->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->first('state_id'))
                                <div class="invalid-feedback">{{ $errors->first('state_id') }}</div>
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

@section('script')
<script>

    $(document).ready(function() {

        $('#countries').change(function(){
            var contryID = $(this).val();
            const stateSelect = $('#states');

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('getStatus') }}",
                    data: {
                        country_id: contryID
                    },
                    success: function (response) {
                        const data = response.states;
                        stateSelect.find('option').remove();
                        $.map(data, function (state, indexOrKey) {
                            stateSelect.append($('<option></option>').val(state.id).html(state.name));
                        });
                    },
                    error: function (error) {
                    }
                });
        });
    });

</script>

@endsection
