@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.states') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

{{-- Search Section --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">

                <form action="{{ route('admin.states.index') }}" method="get" class="form-inline">

                    <div class="form-group">

                        <select name="country" id="country" class="form-control select2">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="{{ __('dashboard.name') }}">
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
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.states') }}
                <a href="{{ route('admin.states.create') }}"
                    class="btn btn-success btn-create {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-left' : 'pull-right' }}">
                    <i class="icon-plus"></i> {{ __('dashboard.create') }}
                </a>
            </div>

            {{-- Tabele --}}
            <div class="card-block">

                @if(!count($states))
                <div class="row">
                    <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
                </div>
                @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('dashboard.lang') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.country') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.name') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.show') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>

                    @foreach($states as $state)
                    <tbody>
                        @foreach($state->translations as $stateTranslation)

                        <tr class="text-sm-center">

                            <td> {{ $stateTranslation->locale }}</td>
                            <td>
                                @if($loop->first)
                                {{ $state->country->name }}
                                @endif
                            </td>

                            <td class="text-sm-center"> {{ $stateTranslation->name  }} </td>

                            <td>
                                @if($loop->first)
                                @if($state->status == '0')
                                <span class="tag tag-danger">{{ __('dashboard.stopped') }}</span>
                                @else
                                <span class="tag tag-success">{{ __('dashboard.active') }}</span>
                                @endif

                                @endif
                            </td>


                            <td>

                                <a href="{{ route('admin.states.show', [$state->id, 'showLang'  => $stateTranslation->locale ] ) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="icon-eye"></i>
                                </a>

                            </td>
                            <td>

                                @if($loop->first)
                                <a href="{{ route('admin.states.edit', $state->id) }}" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </a>
                                <form method="post" action="{{ route('admin.states.destroy', $state->id) }}"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete-form" type="submit">
                                        <i class="icon-trash"></i>
                                    </button>
                                </form>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    @endforeach
                </table>

                {{ $states->appends(request()->query())->links() }}
                @endif

            </div>
        </div>
    </div>
    <!--/col-->
</div>


@endsection
