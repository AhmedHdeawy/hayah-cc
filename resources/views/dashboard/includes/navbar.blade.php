<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="{{ asset('images/logo.png') }}" width="30px"> --}}
        </a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>
        </ul>

        <ul class="nav navbar-nav {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'pull-left' : 'pull-right' }}  hidden-md-down">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="hidden-md-down">{{ __('lang.lang') }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('dashboard/img/AdminLTELogo.png') }} " class="img-avatar img-thumbnail">
                    <span class="hidden-md-down">{{ auth()->guard('admin')->user()->username }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.admins.edit', auth()->guard('admin')->id()) }}"><i class="fa fa-user"></i> {{ __('dashboard.profile') }} </a>

                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa fa-lock"></i> {{ __('dashboard.logout') }}
                        </button>
                    </form>
                </div>
            </li>
            <li class="nav-item"></li>

        </ul>
    </div>
</header>
