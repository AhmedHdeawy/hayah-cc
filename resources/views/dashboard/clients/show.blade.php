@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">{{ __('dashboard.clients') }}</a></li>
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
                        {{ $client->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.age') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $client->age }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $client->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $client->email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.image') }} :
                    </div>
                    <div class="col-sm-10">
                        @if ($client->avatar)
                        <img src="{{ asset('uploads/clients/'.$client->avatar) }}" class="img-fluid img-thumbnail" width="300px">
                        @else
                            --
                        @endif
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($client->status == 1)
                            <strong class="text-success">{{ __('dashboard.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a>

                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
