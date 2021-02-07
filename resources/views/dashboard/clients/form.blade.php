<h5 class="text-primary m-b-h">
    {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="name"> {{ __('dashboard.name') }} </label>
    <div class="col-md-9">

        <input type="text" id="name" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.name') }}" value="{{ old('name', isset($client) ? $client->name : '') }}">

        @if ($errors->first('name'))
        <div class="invalid-feedback text-danger">{{ $errors->first('name') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="phone"> {{ __('dashboard.phone') }} </label>
    <div class="col-md-9">

        <input type="text" id="phone" name="phone"
            class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.phone') }}" value="{{ old('phone', isset($client) ? $client->phone : '') }}">

        @if ($errors->first('phone'))
        <div class="invalid-feedback text-danger">{{ $errors->first('phone') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="email"> {{ __('dashboard.email') }} </label>
    <div class="col-md-9">

        <input type="email" id="email" name="email"
            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.email') }}" value="{{ old('email', isset($client) ? $client->email : '') }}">

        @if ($errors->first('email'))
        <div class="invalid-feedback text-danger">{{ $errors->first('email') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="password"> {{ __('dashboard.password') }} </label>
    <div class="col-md-9">

        <input type="password" id="password" name="password"
            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.password') }}">

        @if ($errors->first('password'))
        <div class="invalid-feedback text-danger">{{ $errors->first('password') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="password_confirmation"> {{ __('dashboard.password_confirmation') }}
    </label>
    <div class="col-md-9">

        <input type="password" id="password_confirmation" name="password_confirmation"
            class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.password_confirmation') }}">

        @if ($errors->first('password_confirmation'))
        <div class="invalid-feedback text-danger">{{ $errors->first('password_confirmation') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label"> {{ __('dashboard.status') }} </label>

    <div class="col-md-9">

        @php
        $status = old('status', isset($client) ? $client->status : 1);
        @endphp

        <label class="radio-inline" for="active">
            <input type="radio" id="active" name="status" value="1" {{ $status == 1 ? 'checked' : '' }}>
            {{ __('dashboard.active') }}
        </label>

        <label class="radio-inline" for="stopped">
            <input type="radio" id="stopped" name="status" value="0" {{ $status == 0 ? 'checked' : '' }}>
            {{ __('dashboard.stopped') }}
        </label>

        @if ($errors->first('status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('status') }}</div>
        @endif

    </div>
</div>
