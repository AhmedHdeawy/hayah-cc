@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('dashboard.infos') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('dashboard.infos') }}
          </div>

          <div class="card-block">

            @if(count($infos) < 1)
              <div class="row">
                <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('dashboard.id') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.lang') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.title') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.desc') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.show') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>

                      @foreach($infos as $info)

                        <tbody>
                            @foreach($info->translations as $infoTranslation)

                              <tr class="text-sm-center">

                                  <td>
                                    @if($loop->first)
                                      {{ $info->id }}
                                    @endif
                                  </td>

                                  <td> {{ $infoTranslation->locale }} </td>

                                  <td>
                                      {{ $infoTranslation->infos_title }}
                                  </td>

                                  <td class="text-sm-center">
                                      {{ \Illuminate\Support\Str::limit(strip_tags($infoTranslation->infos_desc), 50, '...') }}
                                    </td>

                                  <td>
                                    @if($loop->first)
                                      @if($infoTranslation->info->infos_status == '0')
                                        <span class="tag tag-danger">{{ __('dashboard.stopped') }}</span>
                                      @else
                                        <span class="tag tag-success">{{ __('dashboard.active') }}</span>
                                      @endif

                                    @endif
                                  </td>

                                  <td>
                                      <a href="{{ route('admin.infos.show', [$info->id, 'showLang'  => $infoTranslation->locale ] ) }}"
                                          class="btn btn-primary btn-sm">
                                        <i class="icon-eye"></i>
                                      </a>
                                  </td>

                                  <td>

                                    @if($loop->first)


                                      <a href="{{ route('admin.infos.edit', $info->id) }}" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                      </a>
                                    @endif

                                  </td>
                              </tr>
                            @endforeach
                        </tbody>

                      @endforeach
                </table>

                {{ $infos->links() }}
            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
