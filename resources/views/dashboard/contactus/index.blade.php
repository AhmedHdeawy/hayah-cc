@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('dashboard.contactus') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('dashboard.contactus') }}
          </div>

          <div class="card-block">

            @if(count($contactus) < 1)
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
                            <th class="text-sm-center">{{ __('dashboard.message') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($contactus as $contact)
                          <tr class="text-sm-center">

                              <td> {{ $contact->name }} </td>

                              <td> {{ $contact->phone }} </td>

                              <td> {{ $contact->email }} </td>

                              <td> {{ $contact->message }} </td>

                              <td> {{ $contact->created_at->format('Y/m/d - h:i:s') }} </td>

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
