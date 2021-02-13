@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.cards.index') }}">{{ __('dashboard.cards') }}</a></li>
      <li class="breadcrumb-item active">{{ __('dashboard.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.card_id') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $card->card_id }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.start_date') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $card->start_date }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.end_date') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $card->end_date }}
                    </div>
                </div>


            </div>
            <div class="card-footer">
                {{-- <a href="{{ route('admin.cards.edit', $card->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a> --}}

                <a href="{{ route('admin.cards.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
