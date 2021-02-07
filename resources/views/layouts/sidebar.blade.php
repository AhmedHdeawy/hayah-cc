@php
    if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
        $localeLangInverse = 'en';
    } else {
        $localeLangInverse = 'ar';
    }
@endphp

<aside aria-expanded='false' class='menu'>
    <button class='btn' id='close'>
        <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
            <path d='M0 0h24v24H0V0z' fill='none' />
            <path d='M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z' />
        </svg>
    </button>
    <h5> {{ __('lang.websiteName') }} </h5>
    <div class='accordion' id='accordionExample'>
        <nav>
            <ul>
                <li class='nav-item'>
                    <a class='nav-link' href='{{ route('categories') }}'> {{ __('lang.categories') }} </a>
                </li>
                @subscriber
                    <li class='nav-item'>
                        <a class='nav-link' href='{{ route('video.create') }}'> {{ __('lang.addVideo') }} </a>
                    </li>
                @endsubscriber
                @auth
                    @subscriber
                        <li class='nav-item'>
                            <a class='nav-link' href='{{ route('subscriberProfile', auth()->user()->username) }}'> {{ __('lang.profile') }} </a>
                        </li>
                    @else
                        <li class='nav-item'>
                            <a class='nav-link' href='{{ route('userProfile', auth()->user()->username) }}'> {{ __('lang.profile') }} </a>
                        </li>
                    @endsubscriber
                @endauth
                <li class='nav-item'>
                    <a class='nav-link' href='#'> {{ __('lang.guide') }} </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'> {{ __('lang.privacyPolicy') }} </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'> {{ __('lang.about') }} </a>
                </li>
                <li class='nav-item'>
                    <li class='nav-item'>
                        <a class='nav-link' href="{{ str_replace( request()->segment(1),  $localeLangInverse, url()->full() ) }}">
                            {{ __('dashboard.'.$localeLangInverse.'.inverse') }}
                        </a>
                    </li>
                </li>
            </ul>
        </nav>
    </div>
</aside>
