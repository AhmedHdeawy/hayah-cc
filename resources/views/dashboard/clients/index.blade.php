@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.clients') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')


{{-- Search Section --}}
{{-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">

                <form action="{{ route('admin.clients.index') }}" method="get" class="form-inline">

                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="{{ __('dashboard.name') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="{{ __('dashboard.phone') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="{{ __('dashboard.email') }}">
                    </div>

                    <div class="form-group">
                        <select id="status" name="status" class="form-control select-search" size="1">
                            <option value="">{{ __('dashboard.status') }}</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('dashboard.active') }}
                            </option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('dashboard.stopped') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.search') }}
                        </button>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-danger reset-form">
                            <i class="fa fa-ban"></i> {{ __('dashboard.reset') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.clients') }}

                <a href="{{ route('admin.clients.create') }}"
                    class="btn btn-success btn-create {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-left' : 'pull-right' }}">
                    <i class="icon-plus"></i> {{ __('dashboard.create') }}
                </a>
            </div>

            <div class="card-block">

                @if(!count($clients))
                <div class="row">
                    <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
                </div>
                @else
                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('dashboard.name') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.phone') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.email') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($clients as $client)
                        <tr class="text-sm-center">

                            <td> {{ $client->name }} </td>
                            <td> {{ $client->phone }} </td>
                            <td> {{ $client->email }} </td>
                            <td>
                                @if($client->status == 1)
                                <strong class="text-success">{{ __('dashboard.active') }}</strong>
                                @else
                                <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-primary btn-sm">
                                    <i class="icon-eye"></i>
                                </a>

                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </a>

                                <form method="post" action="{{ route('admin.clients.destroy', $client->id) }}"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete-form" type="submit">
                                        <i class="icon-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $clients->appends(request()->query())->links() }}

                @endif

            </div>
        </div>
    </div>
    <!--/col-->
</div>


@endsection
