@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.centers.index') }}">{{ __('dashboard.centers') }}</a></li>
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
                        {{ $center->translate($showLang)->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.address') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->translate($showLang)->address }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.coupon') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->translate($showLang)->coupon }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.discount_value') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->discount_value }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.hours') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->hours }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.category') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->category->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.governorate') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->governorate->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.city') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $center->city->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($center->status == 1)
                            <strong class="text-success">{{ __('dashboard.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.addresses') }} :
                    </div>
                    <div class="col-sm-10">
                        @foreach ($center->branches as $branch)
                            @if ($loop->last)
                                {{ $branch->name }}
                            @else
                                {{ $branch->name }} -
                            @endif
                        @endforeach
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.centers.edit', $center->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.centers.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
