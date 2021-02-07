
<h5 class="text-primary m-b-h">
  {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="name"> {{ __('dashboard.name') }} </label>
    <div class="col-md-9">

        <input type="text" id="name" name="name"
          class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
          placeholder="{{ __('dashboard.name') }}"
          value="{{ old('name', isset($role) ? $role->name : '') }}"
        >

        @if ($errors->first('name'))
          <div class="invalid-feedback text-danger">{{ $errors->first('name') }}</div>
        @endif

    </div>
</div>


<div class="form-group row m-t-2">
  <label class="col-md-3 form-control-label"> {{ __('dashboard.permissions') }} </label>

  <div class="col-md-9">


      @foreach($permissions as $permission)

        {{-- Get Route Name --}}
        @php
          $routeName = explode('.', $permission->name)[1];
          $routeAction = explode('.', $permission->name)[2];

        @endphp

        <div class="col-12 col-md-6 m-t-1">

            <label class="radio-inline" for="{{ $permission->id }}">
                <input type="checkbox" id="{{ $permission->id }}"
                  name="permissions[]"
                  value="{{ $permission->id }}"
                  {{ isset($rolePermissions) && in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                >
                {{ __('dashboard.'. $routeAction) }} {{ __('dashboard.'. $routeName) }}
            </label>
        </div>
      @endforeach

      @if ($errors->first('status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('status') }}</div>
      @endif

  </div>
</div>


