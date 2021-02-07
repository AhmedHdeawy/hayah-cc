<h5 class="text-primary m-b-h">
    {{ __('dashboard.staticData') }}
</h5>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="image"> {{ __('dashboard.image') }} </label>
      <div class="col-md-9">

          <input type="file" id="image" name="image"
            class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}"
          >

          @if ($errors->first('image'))
            <div class="invalid-feedback text-danger">{{ $errors->first('image') }}</div>
          @endif

      </div>
  </div>

<div class="form-group row">
    <label class="col-md-3 form-control-label"> {{ __('dashboard.status') }} </label>

    <div class="col-md-9">

        @php
        $status = old('status', isset($blog) ? $blog->status : 1);
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


@foreach($languages as $languag)


<h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('dashboard.'. $languag->locale .'Data') }}
</h5>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[title]"> {{ __('dashboard.title') }} </label>
    <div class="col-md-9">
        <textarea type="text" id="{{ $languag->locale }}[title]" name="{{ $languag->locale }}[title]"
            class="form-control {{ $errors->first($languag->locale .'.title') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.title') }}">{{ old($languag->locale .'title', isset($blog) ? $blog->translate($languag->locale)->title : '') }}</textarea>

        @if ($errors->first($languag->locale .'.title'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.title') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[content]"> {{ __('dashboard.content') }} </label>
    <div class="col-md-9">
        <textarea rows="20" type="text" id="{{ $languag->locale }}[content]" name="{{ $languag->locale }}[content]"
            class="form-control {{ $languag->locale . '_ckEditor' }} {{ $errors->first($languag->locale .'.content') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.content') }}">{{ old($languag->locale .'content', isset($blog) ? $blog->translate($languag->locale)->content : '') }}</textarea>

        @if ($errors->first($languag->locale .'.content'))
        <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.content') }}</div>
        @endif

    </div>
</div>

@endforeach
