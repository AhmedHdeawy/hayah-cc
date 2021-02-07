<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ asset('front/images/logo-icon.png') }}" type="image/png" sizes="16x16">

  <title>{{ __('dashboard.websiteAdminPanel') }}</title>


  <!-- Fonts CSS-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900">
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">


  <!-- Icons CSS-->
  <link rel="stylesheet" href="{{ asset('dashboard/css/simple-line-icons.css') }}">

  <!-- Styles CSS-->
  @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-en.css') }}">
  @endif

  {{-- Plugins --}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">


  <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">

  @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-en.css') }}">
  @endif

</head>


<body class="navbar-fixed sidebar-nav fixed-nav">


    <!-- Main Navbar-->
    @include('dashboard.includes.navbar')
    <!-- End / Main Navbar-->


    <!-- Main Sidebar-->
    @include('dashboard.includes.sidebar')
    <!-- End / Main Sidebar-->

    {{-- Page Content --}}
    <main class="main">
      <!-- Breadcrumb -->
        <ol class="breadcrumb">
          @yield('breadcrumb')
        </ol>
      <!-- End / Breadcrumb -->

      {{-- Page Content --}}
        <div class="container-fluid">
          <div class="animated fadeIn">
              @yield('content')
          </div>
        </div>
      {{-- End / Page Content --}}
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <span class="pull-left">
            {{ __('dashboard.poweredBy') }}
            <a href="https://eg.mostaql.com/u/AhmedHdeawy/portfolio" target="_blank">Ahmed Hdeawy</a>
        </span>

        <span class="pull-right">
             <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>

    <!-- CoreUI main scripts -->
    <script src="{{ asset('dashboard/js/app.js') }}"></script>

    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('dashboard/js/libs/alertify.min.js') }}"></script>

    <!-- Custom scripts required by this view -->
    <script src="{{ asset('dashboard/js/views/main.js') }}"></script>

    <script src="{{ asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/chart-js/chart.js') }}"></script>

    {{-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> --}}

    <script src="{{ asset('dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/ckeditor/translations/ar.js') }}"></script>

    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
    @yield('script')
    @stack('js')

</body>
</html>
