<h5 class="text-primary m-b-h">
    {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label"> {{ __('dashboard.status') }} </label>

    <div class="col-md-9">

        @php
        $status = old('status', isset($city) ? $city->status : 1);
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

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="governorates"> {{ __('dashboard.governorates') }} </label>
      <div class="col-md-9">
        <select class="form-control select2 {{ $errors->first('governorate_id') ? 'is-invalid' : '' }}" id="governorates" name="governorate_id"
           placeholder="{{ __('dashboard.governorates') }}">
            <option value=""></option>
            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}"
                    {{ isset($city) && $city->governorate_id == $governorate->id ? 'selected' : '' }}>{{ $governorate->name }}
                </option>
            @endforeach
        </select>

          @if ($errors->first('governorate_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('governorate_id') }}</div>
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
            placeholder="{{ __('dashboard.name') }}">{{ old($languag->locale .'name', isset($city) ? $city->translate($languag->locale)->name : '') }}</textarea>

        @if ($errors->first($languag->locale .'.name'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.name') }}</div>
        @endif

    </div>
</div>

@endforeach
