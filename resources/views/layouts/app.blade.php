<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/opensans.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa.css') }}" rel="stylesheet" />
        @yield('style')
        <link
            rel="shortcut icon"
            href="{{ asset('image/icon.png') }}"
            type="image/x-icon"
        />
    </head>

    <body data-spy="scroll" data-target="#navbar">
        <header id="home">
            <nav
                id="navbar"
                class="navbar navbar-expand-lg navbar-light bg-light"
            >
                <div class="container">
                    <img src="{{ asset("image/logo.gif") }}" class="img-fluid"
                    alt="logo" style="height: 42px;"">
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h4 style="font-weight: bold">Video Management</h4>
                </div>
            </nav>
        </header>
        <div class="content">@yield('content')</div>
        <div class="container-fluid footer-section">
            <div class="container text-center">
                <div class="col-xs-12 col-md-12">
                    &copy; 2023 ONEPLAY - Video Management. All Rights Reserved.
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>
