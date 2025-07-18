<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="author" content="MIMAX SOFTWARE GROUP">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('head_title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/admin/assets/img/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap.min.css') }}">
    @stack('style')

    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/animate.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/select2/css/select2.min.css') }}">
  
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/feather.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/fontawesome/css/all.min.css') }}">
  
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/style.css') }}">
  </head>

  <body>
    <div id="global-loader">
      <div class="whirly-loader"> </div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
      <!-- Header -->
      @livewire('Admin\\Components\\AdminHeader')
      <!-- /Header -->
      <!-- Sidebar -->
      @livewire('Admin\\Components\\AdminSidebar')
      <!-- /Sidebar -->
      <div class="page-wrapper">
        <div class="content">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- /Main Wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('/admin/assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('/admin/assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('/admin/assets/js/jquery.slimscroll.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('/admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    @stack('scripts')

    <!-- Sweetalert 2 -->
    <script src="{{ asset('/admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('/admin/assets/js/theme-script.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/script.js') }}"></script>
  </body>
</html>