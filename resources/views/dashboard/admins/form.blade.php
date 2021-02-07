
<h5 class="text-primary m-b-h">
  {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="username"> {{ __('dashboard.username') }} </label>
      <div class="col-md-9">

          <input type="text" id="username" name="username"
            class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.username') }}"
            value="{{ old('username', isset($admin) ? $admin->username : '') }}"
          >

          @if ($errors->first('username'))
            <div class="invalid-feedback text-danger">{{ $errors->first('username') }}</div>
          @endif

      </div>
  </div>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="email"> {{ __('dashboard.email') }} </label>
      <div class="col-md-9">

          <input type="email" id="email" name="email"
            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.email') }}"
            value="{{ old('email', isset($admin) ? $admin->email : '') }}"
          >

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
            placeholder="{{ __('dashboard.password') }}"
          >

          @if ($errors->first('password'))
            <div class="invalid-feedback text-danger">{{ $errors->first('password') }}</div>
          @endif

      </div>
  </div>

  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="password_confirmation"> {{ __('dashboard.password_confirmation') }} </label>
      <div class="col-md-9">

          <input type="password" id="password_confirmation" name="password_confirmation"
            class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.password_confirmation') }}"
          >

          @if ($errors->first('password_confirmation'))
            <div class="invalid-feedback text-danger">{{ $errors->first('password_confirmation') }}</div>
          @endif

      </div>
  </div>

  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="roles"> {{ __('dashboard.permissions') }} </label>
      <div class="col-md-9">


        <select class="form-control select2 {{ $errors->first('roles') ? 'is-invalid' : '' }}" id="roles" name="roles[]"
           placeholder="{{ __('dashboard.roles') }}" multiple>
            <option value=""></option>
            @foreach ($roles as $role)
              <option value="{{ $role }}" {{ isset($admin) && $admin->hasRole($role) ? 'selected' : '' }}>{{ $role }}</option>
            @endforeach
        </select>

          @if ($errors->first('roles'))
            <div class="invalid-feedback text-danger">{{ $errors->first('roles') }}</div>
          @endif

      </div>
  </div>



