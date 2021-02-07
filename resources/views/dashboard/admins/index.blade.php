@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('dashboard.admins') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')



<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">

        <form action="{{ route('admin.admins.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="{{ __('dashboard.username') }}">
            </div>

            <div class="form-group">
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('dashboard.email') }}">
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
              <i class="fa fa-align-justify"></i> {{ __('dashboard.admins') }}

              <a href="{{ route('admin.admins.create') }}" class="btn btn-success btn-create {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('dashboard.create') }}
              </a>
          </div>

          <div class="card-block">

            @if(count($admins) < 1)
              <div class="row">
                <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('dashboard.name') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.email') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.permissions') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($admins as $admin)
                          <tr class="text-sm-center">

                              <td> {{ $admin->username }} </td>
                              <td> {{ $admin->email }} </td>
                              <td>
                                  @foreach ($admin->roles as $role)
                                    @if ($loop->last)
                                        {{ $role->name }}
                                        @else
                                        {{ $role->name }} <b>||</b>
                                    @endif
                                  @endforeach
                              </td>

                              <td>
                                <a href="{{ route('admin.admins.show', $admin->id) }}"
                                    class="btn btn-primary btn-sm">
                                  <i class="icon-eye"></i>
                                </a>

                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </a>

                                <form method="post" action="{{ route('admin.admins.destroy', $admin->id) }}" class="d-inline-block">
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

            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
