@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('dashboard.roles') }}</a></li>
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
                        {{ $role->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $role->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $role->email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.image') }} :
                    </div>
                    <div class="col-sm-10">
                        <img src="{{ asset('uploads/roles/'.$role->avatar) }}" class="img-fluid img-thumbnail" width="300px">
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($role->status == 1)
                            <strong class="text-success">{{ __('dashboard.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a>

                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
