@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">{{ __('dashboard.admins') }}</a></li>
      <li class="breadcrumb-item active">{{ __('dashboard.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.username') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $admin->username }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $admin->email }}
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a>

                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
