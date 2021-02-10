@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.center-branches.index') }}">{{ __('dashboard.center-branches') }}</a></li>
      <li class="breadcrumb-item active">{{ __('dashboard.show') }}</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">

        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.center') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->center->name }}
                    </div>
                </div>


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.name') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->translate($showLang)->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.address') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->translate($showLang)->address }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.coupon') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->translate($showLang)->coupon }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.discount_value') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->discount_value }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.hours') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->hours }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.category') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->category->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.governorate') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->governorate->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.city') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $centerBranch->city->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($centerBranch->status == 1)
                            <strong class="text-success">{{ __('dashboard.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.center-branches.edit', $centerBranch->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a>

                <a href="{{ route('admin.center-branches.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
