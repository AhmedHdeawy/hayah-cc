@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
    <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
@endsection

@section('content')

<h3 class="m-b-1">
	{{ __('dashboard.websiteStatistics') }}
</h3>

<div class="row dashboard-statistic">

	<div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.users.index') }}">
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-people bg-primary p-a-1 font-2xl m-r-1 {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\User') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('dashboard.users') }}</div>
	            </div>
	        </div>
        </a>
    </div>

</div>
{{--
<div class="row m-y-3">
    <div class="col-xs-10 m-b-3">
        <h3 class="m-b-3">
            {{ __('dashboard.recentProperties') }}
        </h3>
        @include('dashboard.dashboard.newProperties')
    </div>

</div>

<div class="row m-y-3">
    <h3 class="m-y-3">
        {{ __('dashboard.activePropertiesToStoppedProperties') }}
    </h3>
    <div class="col-xs-10">
        @include('dashboard.dashboard.propertiesStatus')
    </div>

</div> --}}

@endsection


@section('script')
<script>
	$(document).ready(function() {

		chartColors = {
			active			: 'rgb(32, 168, 216)',
			stopped	        : 'rgb(248, 108, 107)',
		};
	});
</script>
@endsection
