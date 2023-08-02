<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Webpage Title -->
        <title>Zuffy Store</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
            rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/fontawesome-all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/swiper.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/styles.css') }}" rel="stylesheet">

        <!-- Favicon  -->
        <link rel="icon" href="{{ asset('assets/frontend/images/favicon.png') }}">
        @yield('styles')
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            
            .btn-solid-cs {
                display: inline-block;
                padding: 1rem 1.5rem 1rem 1.5rem;
                border: 1px solid #ff5574;
                border-radius: 30px;
                background-color: #ff5574;
                color: #ffffff;
                font-weight: 600;
                font-size: 0.875rem;
                line-height: 0;
                text-decoration: none;
                transition: all 0.2s;
            }

            .btn-solid-cs:hover {
                background-color: transparent;
                color: #ff5574;
                text-decoration: none;
            }

            .navbar .btn-solid-cs {
                border-color: #ff5574;
                background-color: #ff5574;
            }

            .navbar .btn-solid-cs:hover {
                background-color: transparent;
                color: #ff5574;
            }

            .navbar .nav-item .btn-solid-cs {
                margin-top: 0;
                margin-left: 1rem;
            }
        </style>
    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbarExample">
        @include('layouts.frontend.partials.navbar')

        @yield('content')

        @include('layouts.frontend.partials.footer')

        <!-- Scripts -->
        <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/swiper.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/scripts.js')}}"></script>
        @yield('script')
</html>