<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ $segment == null ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                    <i class="icon-home"></i> {{ __('dashboard.home') }}
                </a>
            </li>

            @if(auth('admin')->user()->can('admin.categories.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="icon-layers"></i> {{ __('dashboard.categories') }}
                </a>
            </li>
            @endif


            @if(auth('admin')->user()->can('admin.governorates.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'governorates' ? 'active' : '' }}" href="{{ route('admin.governorates.index') }}">
                    <i class="icon-layers"></i> {{ __('dashboard.governorates') }}
                </a>
            </li>
            @endif


            @if(auth('admin')->user()->can('admin.cities.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'cities' ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">
                    <i class="icon-layers"></i> {{ __('dashboard.cities') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.centers.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'centers' ? 'active' : '' }}" href="{{ route('admin.centers.index') }}">
                    <i class="icon-location-pin"></i> {{ __('dashboard.centers') }}
                </a>
            </li>
            @endif


            @if(auth('admin')->user()->can('admin.center-branches.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'center-branches' ? 'active' : '' }}" href="{{ route('admin.center-branches.index') }}">
                    <i class="icon-location-pin"></i> {{ __('dashboard.center-branches') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.cards.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'cards' ? 'active' : '' }}" href="{{ route('admin.cards.index') }}">
                    <i class="icon-credit-card"></i> {{ __('dashboard.cards') }}
                </a>
            </li>
            @endif


            @if(auth('admin')->user()->can('admin.admins.view'))
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'admins' ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                    <i class="icon-diamond"></i> {{ __('dashboard.admins') }}
                </a>
            </li>
            @endif

            @if(auth('admin')->user()->can('admin.admins.view'))
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'roles' ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                    <i class="icon-diamond"></i> {{ __('dashboard.roles') }}
                </a>
            </li>
            @endif


        </ul>
    </nav>
</div>

{{--   <li class="{{ $segment == null ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i
        class="icon-home"></i>Home </a></li>

<li class="{{ in_array($segment, ['categories']) ? 'active' : '' }}">
    <a href="{{ route('dashboard.categories') }}">
        <i class="fa fa-list fa-lg"></i>
        <span class="px-2">Categories</span>
    </a>
</li>
--}}
