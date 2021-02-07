@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.states.index') }}">{{ __('dashboard.states') }}</a></li>
      <li class="breadcrumb-item active">{{ __('dashboard.show') }}</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">

        <div class="card">
            <div class="card-block">


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.name') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $state->translate($showLang)->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.country') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $state->country->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($state->status == 1)
                            <strong class="text-success">{{ __('dashboard.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.states.edit', $state->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
