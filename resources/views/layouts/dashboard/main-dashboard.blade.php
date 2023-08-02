<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Admin Dashboard</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendors/iconly/bold.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendors/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/vendors/fontawesome/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/css/app.css') }}">
        <link rel="icon" href="{{ asset('assets/frontend/images/favicon.png') }}">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
        @yield('styles')
    </head>

    <body>
        <div id="app">
            <!-- sidebar -->
            @include('layouts.dashboard.partials.sidebar')

            <div id="main" class="layout-navbar">
                <!-- header -->
                @include('layouts.dashboard.partials.header')

                <!-- content -->
                <div id="main-content">
                    @yield('main-breadcrumb')
                    
                    @yield('main-dashboard')

                    <!-- footer -->
                    @include('layouts.dashboard.partials.footer')
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/backend/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/main.js') }}"></script>
        <script src="{{ asset('assets/backend/vendors/fontawesome/all.min.js') }}"></script>
        @yield('script')
    </body>
</html>