<nav class='navbar navbar-expand'>
	<div class='container'>
		<div class='nav-con'>
			<button class='btn menu-open'>
				<svg height='24px' viewBox='0 0 24 24' width='24px' xmlns='http://www.w3.org/2000/svg'>
					<path d='M0 0h24v24H0V0z' fill='none'/>
					<path
							d='M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zm0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zM3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1z'/>
				</svg>
			</button>
			<a class='navbar-brand' href='/'>
				<svg height='64px' viewBox='0 0 61.56 57.24' xmlns='http://www.w3.org/2000/svg'>
					<g>
						<path
								d='M30,54.24A25.6,25.6,0,0,1,4.05,30.17C3.35,13.33,16.65,3.4,28.84,2.93A25.9,25.9,0,0,1,55.63,29.38C55.38,42.69,43.74,54.47,30,54.24ZM7.09,28.62c-.36,11.65,9.7,23.57,24.54,22.6A22.42,22.42,0,0,0,52.51,28,22.36,22.36,0,0,0,30.15,6,22.46,22.46,0,0,0,7.09,28.62Z'/>
						<path
								d='M29.77,48.85a20.24,20.24,0,1,1-.22-40.48c11.36,0,20.72,9,20.69,20A20.36,20.36,0,0,1,29.77,48.85Zm.67-35.29c-7-.21-13.35,4.26-14.61,11.19-.88,4.86-.19,9.38,3,13.37,4.84,6.08,16.1,6.65,22.7.55a2.21,2.21,0,0,0,.19-2.15,34.17,34.17,0,0,0-4.26-4.33,2,2,0,0,0-1.91,0A7.26,7.26,0,0,1,29,34.45a5.71,5.71,0,0,1-4.69-4.13c-.54-2.47.5-6.1,2-7.09a7.48,7.48,0,0,1,8.76.83,1.41,1.41,0,0,0,2.3,0c1.29-1.24,2.59-2.49,3.91-3.7a1.25,1.25,0,0,0,0-2.12C38.28,15.33,34.81,13.41,30.44,13.56Z'/>
					</g>
				</svg>
			</a>
			<ul class='navbar-nav'>

                @auth
                    <li class='nav-item login'>
                        {{-- <a class='nav-link' href='{{ route('login') }}'> {{__('lang.logout')}} </a> --}}
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class='nav-link no-btn' type="submit">
                                {{ __('lang.logout') }}
                            </button>
                        </form>
                    </li>
                @else
                    <li class='nav-item login'>
                        <a class='nav-link' href='{{ route('login') }}'> {{__('lang.login')}} </a>
                    </li>
                    <li class='nav-item login'>
                        <a class='nav-link' href='{{ route('register') }}'> {{__('lang.register')}} </a>
                    </li>
                    <li class='nav-item register'>
                        <a class='nav-link' href='{{ route('register-subscriber') }}'>{{__('lang.subscriber')}}</a>
                    </li>
                @endauth

			</ul>
		</div>
	</div>
</nav>

{{--
@foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
        {{ $properties['native'] }}
    </a>
@endforeach --}}
