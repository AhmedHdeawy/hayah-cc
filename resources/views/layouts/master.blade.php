<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset='UTF-8'>
    <meta name='theme-color' content='#363062'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>
    <link href='https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap' rel='stylesheet' as='font'>
    <script crossorigin='anonymous' src='https://kit.fontawesome.com/9a07467a57.js' async></script>
    <link rel="stylesheet" href="{{  mix('css/app.css') }}">
    <link rel="stylesheet" href="{{  asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">

</head>

<!-- class="rtl" -->

<body dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" style="text-align: {{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}" '>
    {{-- App Navbar --}}
    @include('layouts.navbar')
    {{-- App Navbar / End --}}

    <div class='content-wrapper'>

        {{-- Main Section --}}
            @yield('content')
        {{-- Main Section / End --}}

        {{-- Footer --}}
        @include('layouts.footer')
        {{-- Footer / End --}}
    </div>

    {{-- Footer --}}
    @include('layouts.sidebar')
    {{-- Footer / End --}}

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
    @yield('script')
    <script src="{{ mix('js/all.js') }}"></script>

</body>

</html>
