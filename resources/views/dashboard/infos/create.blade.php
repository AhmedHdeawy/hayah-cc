@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.infos.index') }}"> {{ __('dashboard.infos') }} </a></li>
  <li class="breadcrumb-item active">{{ __('dashboard.create') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

  <form action="{{ route('admin.infos.store') }}" method="post" class="form-horizontal " enctype="multipart/form-data">

    <div class="card">
      <div class="card-header">
          {{ __('dashboard.data') }}
      </div>
      <div class="card-block">
          @csrf
          @include('dashboard.infos.form')
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.save') }}
          </button>
          <button type="button" class="btn btn-sm btn-danger reset-form"><i class="fa fa-ban"></i>
            {{ __('dashboard.resetInputs') }}
          </button>
      </div>
    </div>

  </form>


@endsection
