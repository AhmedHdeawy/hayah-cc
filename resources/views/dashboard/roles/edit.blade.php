@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"> {{ __('dashboard.roles') }} </a></li>
  <li class="breadcrumb-item active">{{ __('dashboard.edit') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

  <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form-horizontal " enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="card">
      <div class="card-header">
          {{ __('dashboard.data') }}
      </div>
      <div class="card-block">
          @csrf
          @include('dashboard.roles.form')
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.update') }}
          </button>
          <button type="button" class="btn btn-sm btn-danger reset-form"><i class="fa fa-ban"></i>
            {{ __('dashboard.resetInputs') }}
          </button>
      </div>
    </div>

  </form>


@endsection

