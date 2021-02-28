<h5 class="text-primary m-b-h">
    {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label"> {{ __('dashboard.status') }} </label>

    <div class="col-md-9">

        @php
        $status = old('status', isset($centerBranch) ? $centerBranch->status : 1);
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

<div class="form-group row mb-5">
      <label class="col-md-3 form-control-label" for="logo"> {{ __('dashboard.image') }} </label>
      <div class="col-md-9">

          @include('dashboard.includes.uploadImage',
            ['name' => 'logo', 'value' => isset($centerBranch) ? $centerBranch->logo : null, 'path' => 'storage/']
            )

          @if ($errors->first('logo'))
            <div class="invalid-feedback text-danger">{{ $errors->first('logo') }}</div>
          @endif

      </div>
</div>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="centers"> {{ __('dashboard.centers') }} </label>
      <div class="col-md-9">
        <select class="form-control select2 {{ $errors->first('category_id') ? 'is-invalid' : '' }}" id="centers" name="center_id"
           placeholder="{{ __('dashboard.centers') }}">
            <option value=""></option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}"
                    {{ isset($centerBranch) && $centerBranch->center_id == $center->id ? 'selected' : '' }}>{{ $center->name }}
                </option>
            @endforeach
        </select>

          @if ($errors->first('center_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('center_id') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="categories"> {{ __('dashboard.categories') }} </label>
      <div class="col-md-9">
        <select class="form-control select2 {{ $errors->first('category_id') ? 'is-invalid' : '' }}" id="categories" name="category_id"
           placeholder="{{ __('dashboard.categories') }}">
            <option value=""></option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ isset($centerBranch) && $centerBranch->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                </option>
            @endforeach
        </select>

          @if ($errors->first('category_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('category_id') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="governorates"> {{ __('dashboard.governorates') }} </label>
      <div class="col-md-9">
        <select class="form-control select2 {{ $errors->first('governorate_id') ? 'is-invalid' : '' }}" id="governorates" name="governorate_id"
           placeholder="{{ __('dashboard.governorates') }}">
            <option value=""></option>
            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}"
                    {{ isset($centerBranch) && $centerBranch->governorate_id == $governorate->id ? 'selected' : '' }}>{{ $governorate->name }}
                </option>
            @endforeach
        </select>

          @if ($errors->first('governorate_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('governorate_id') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="cities"> {{ __('dashboard.cities') }} </label>
      <div class="col-md-9">
        <select class="form-control select2 {{ $errors->first('city_id') ? 'is-invalid' : '' }}" id="cities" name="city_id"
           placeholder="{{ __('dashboard.cities') }}">
            <option value=""></option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}"
                    {{ isset($centerBranch) && $centerBranch->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}
                </option>
            @endforeach
        </select>

          @if ($errors->first('city_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('city_id') }}</div>
          @endif

      </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="hours"> {{ __('dashboard.hours') }} </label>
    <div class="col-md-9">

        <input type="text" id="hours" name="hours"
            class="form-control {{ $errors->first('hours') ? 'is-invalid' : '' }}"
            value="{{ old('hours', isset($centerBranch) ? $centerBranch->hours : '') }}"
            placeholder="{{ __('dashboard.hours') }}">

        @if ($errors->first('hours'))
        <div class="invalid-feedback text-danger">{{ $errors->first('hours') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="phone"> {{ __('dashboard.phone') }} </label>
    <div class="col-md-9">

        <input type="text" id="phone" name="phone"
            class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
            value="{{ old('phone', isset($centerBranch) ? $centerBranch->phone : '') }}"
            placeholder="{{ __('dashboard.phone') }}">

        @if ($errors->first('phone'))
        <div class="invalid-feedback text-danger">{{ $errors->first('phone') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="discount_value"> {{ __('dashboard.discount_value') }} </label>
    <div class="col-md-9">
        <input type="text" id="discount_value" name="discount_value"
            class="form-control {{ $errors->first('discount_value') ? 'is-invalid' : '' }}"
            value="{{ old('discount_value', isset($centerBranch) ? $centerBranch->discount_value : '') }}"
            placeholder="{{ __('dashboard.discount_value') }}">
        @if ($errors->first('discount_value'))
            <div class="invalid-feedback text-danger">{{ $errors->first('discount_value') }}</div>
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="latitude"> {{ __('dashboard.latitude') }} </label>
    <div class="col-md-9">

        <input type="text" id="latitude" name="latitude"
            class="form-control {{ $errors->first('latitude') ? 'is-invalid' : '' }}"
            value="{{ old('latitude', isset($centerBranch) ? $centerBranch->latitude : '') }}"
            placeholder="{{ __('dashboard.latitude') }}">

        @if ($errors->first('latitude'))
        <div class="invalid-feedback text-danger">{{ $errors->first('latitude') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="longitude"> {{ __('dashboard.longitude') }} </label>
    <div class="col-md-9">

        <input type="text" id="longitude" name="longitude"
            class="form-control {{ $errors->first('longitude') ? 'is-invalid' : '' }}"
            value="{{ old('longitude', isset($centerBranch) ? $centerBranch->longitude : '') }}"
            placeholder="{{ __('dashboard.longitude') }}">

        @if ($errors->first('longitude'))
        <div class="invalid-feedback text-danger">{{ $errors->first('longitude') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="notes"> {{ __('dashboard.notes') }} </label>
    <div class="col-md-9">

        <textarea type="text" id="notes" name="notes"
            class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.notes') }}">{{ old('notes', isset($centerBranch) ? $centerBranch->notes : '') }}</textarea>

        @if ($errors->first('notes'))
        <div class="invalid-feedback text-danger">{{ $errors->first('notes') }}</div>
        @endif

    </div>
</div>


@foreach($languages as $languag)


<h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('dashboard.'. $languag->locale .'Data') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[name]"> {{ __('dashboard.name') }} </label>
    <div class="col-md-9">

        <textarea type="text" id="{{ $languag->locale }}[name]" name="{{ $languag->locale }}[name]"
            class="form-control {{ $errors->first($languag->locale .'.name') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.name') }}">{{ old($languag->locale .'name', isset($centerBranch) ? $centerBranch->translate($languag->locale)->name : '') }}</textarea>

        @if ($errors->first($languag->locale .'.name'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.name') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[address]"> {{ __('dashboard.address') }} </label>
    <div class="col-md-9">

        <textarea type="text" id="{{ $languag->locale }}[address]" name="{{ $languag->locale }}[address]"
            class="form-control {{ $errors->first($languag->locale .'.address') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.address') }}">{{ old($languag->locale .'address', isset($centerBranch) ? $centerBranch->translate($languag->locale)->address : '') }}</textarea>

        @if ($errors->first($languag->locale .'.address'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.address') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[coupon]"> {{ __('dashboard.coupon') }} </label>
    <div class="col-md-9">

        <textarea type="text" id="{{ $languag->locale }}[coupon]" name="{{ $languag->locale }}[coupon]"
            class="form-control {{ $errors->first($languag->locale .'.coupon') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.coupon') }}">{{ old($languag->locale .'coupon', isset($centerBranch) ? $centerBranch->translate($languag->locale)->coupon : '') }}</textarea>

        @if ($errors->first($languag->locale .'.coupon'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.coupon') }}</div>
        @endif

    </div>
</div>

@endforeach
