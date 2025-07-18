<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
        <title>INNOWEEK.UZ - Innovatsion g'oyalar haftaligi platformasi</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/admin/assets/img/favicon.ico') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/admin/assets/plugins/fontawesome/css/all.min.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('/admin/assets/css/style.css') }}">

    </head>

    <body class="account-page">
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <div class="account-content">
                <div class="login-wrapper">
                    @yield('content')

                    <div class="login-img">
                        <img src="{{ asset('/admin/assets/img/authentication/login02.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('/admin/assets/js/jquery-3.7.1.min.js') }}"></script>

        <!-- Feather Icon JS -->
        <script src="{{ asset('/admin/assets/js/feather.min.js') }}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{ asset('/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('/admin/assets/js/theme-script.js') }}"></script>
        <script src="{{ asset('/admin/assets/js/script.js') }}"></script>
    </body>
</html>