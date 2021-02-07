@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('dashboard.users') }}</a></li>
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
                        {{ $user->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.country') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->country->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.state') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->state->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->email }}
                    </div>
                </div>

                @if ($user->youtube_channel)
                    <div class="row show-details-row">
                        <div class="col-sm-2">
                            {{ __('dashboard.youtube_channel') }} :
                        </div>
                        <div class="col-sm-10">
                            {{ $user->youtube_channel }}
                        </div>
                    </div>
                @endif

                @if ($user->instagram_channel)
                    <div class="row show-details-row">
                        <div class="col-sm-2">
                            {{ __('dashboard.instagram_channel') }} :
                        </div>
                        <div class="col-sm-10">
                            {{ $user->instagram_channel }}
                        </div>
                    </div>
                @endif


                @if ($user->channel_url)
                    <div class="row show-details-row">
                        <div class="col-sm-2">
                            {{ __('dashboard.channel_url') }} :
                        </div>
                        <div class="col-sm-10">
                            {{ $user->channel_url }}
                        </div>
                    </div>
                @endif

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($user->status == 1)
                            <strong class="text-success">{{ __('dashboard.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                {{-- <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                  {{ __('dashboard.edit') }}
                </a> --}}

                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
