<h5 class="text-primary m-b-h">
    {{ __('dashboard.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="card_id"> {{ __('dashboard.card_id') }} </label>
    <div class="col-md-9">

        <input type="text" id="card_id" name="card_id" class="form-control {{ $errors->first('card_id') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.card_id') }}" value="{{ old('card_id', isset($card) ? $card->card_id : '') }}">

        @if ($errors->first('card_id'))
        <div class="invalid-feedback text-danger">{{ $errors->first('card_id') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="start_date"> {{ __('dashboard.start_date') }} </label>
    <div class="col-md-9">

        <input type="date" id="start_date" name="start_date" class="form-control {{ $errors->first('start_date') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.start_date') }}" value="{{ old('start_date', isset($card) ? $card->start_date : '') }}">

        @if ($errors->first('start_date'))
        <div class="invalid-feedback text-danger">{{ $errors->first('start_date') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="end_date"> {{ __('dashboard.end_date') }} </label>
    <div class="col-md-9">

        <input type="date" id="end_date" name="end_date" class="form-control {{ $errors->first('end_date') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.end_date') }}" value="{{ old('end_date', isset($card) ? $card->end_date : '') }}">

        @if ($errors->first('end_date'))
        <div class="invalid-feedback text-danger">{{ $errors->first('end_date') }}</div>
        @endif

    </div>
</div>



<div class="form-group row">
    <label class="col-md-3 form-control-label" for="notes"> {{ __('dashboard.notes') }} </label>
    <div class="col-md-9">
        <textarea type="text" id="notes" name="notes" class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}"
            placeholder="{{ __('dashboard.notes') }}"
        >{{ old('notes', isset($card) ? $card->notes : '') }}</textarea>
        @if ($errors->first('notes'))
        <div class="invalid-feedback text-danger">{{ $errors->first('notes') }}</div>
        @endif

    </div>
</div>
