@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.center-branches') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.center-branches') }}

                <a href="{{ route('admin.center-branches.create') }}" class="btn btn-success btn-create {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-left' : 'pull-right' }}">
                    <i class="icon-plus"></i> {{ __('dashboard.create') }}
                </a>
            </div>

            <div class="card-block">

                @if(count($centerBranches) < 1) <div class="row">
                    <h4 class="col-12 text-danger text-xs-centerBranch"> {{ __('dashboard.noData') }} </h4>
            </div>
            @else

            <table class="table table-bordered table-striped table-condensed">
                {{-- Table Header --}}
                <thead>
                    <tr>
                        <th class="text-sm-centerBranch">{{ __('dashboard.lang') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.center') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.governorate') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.name') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.status') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.show') }}</th>
                        <th class="text-sm-centerBranch">{{ __('dashboard.actions') }}</th>
                    </tr>
                </thead>

                @foreach($centerBranches as $centerBranch)

                <tbody>
                    @foreach($centerBranch->translations as $centerBranchTranslation)

                    <tr class="text-sm-centerBranch">

                        <td> {{ $centerBranchTranslation->locale }} </td>
                        <td>
                            @if($loop->first)
                            {{ $centerBranch->center->name }}
                            @endif
                        </td>

                        <td class="text-sm-centerBranch">
                            @if($loop->first)
                            {{ $centerBranch->governorate->name }}
                            @endif
                        </td>
                        <td class="text-sm-centerBranch"> {{ $centerBranchTranslation->name  }} </td>

                        <td>
                            @if($loop->first)
                            @if($centerBranch->status == '0')
                            <span class="tag tag-danger">{{ __('dashboard.stopped') }}</span>
                            @else
                            <span class="tag tag-success">{{ __('dashboard.active') }}</span>
                            @endif

                            @endif
                        </td>


                        <td>

                            <a href="{{ route('admin.center-branches.show', [$centerBranch->id, 'showLang'  => $centerBranchTranslation->locale ] ) }}"
                                class="btn btn-primary btn-sm">
                                <i class="icon-eye"></i>
                            </a>

                        </td>
                        <td>

                            @if($loop->first)
                            <a href="{{ route('admin.center-branches.edit', $centerBranch->id) }}" class="btn btn-warning btn-sm">
                                <i class="icon-pencil"></i>
                            </a>
                            <form method="post" action="{{ route('admin.center-branches.destroy', $centerBranch->id) }}" class="d-inline-block">
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

            {{ $centerBranches->links() }}
            @endif

        </div>
    </div>
</div>
<!--/col-->
</div>


@endsection
