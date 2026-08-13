<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Spaceship X26') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Spaceship Theme CSS -->
    <link href="{{ asset('css/spaceship-theme.css') }}?v={{ time() }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- ==============================
         GLOBAL HEADER & NAVIGATION
         ============================== -->
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-gradient">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- ==============================
         MAIN CONTENT INJECTION
         ============================== -->
    <!-- The flex-grow-1 class is the magic that pushes the footer down -->
    <main class="main-content flex-grow-1">
        @yield('content')
    </main>

    <!-- ==============================
         GLOBAL MISSION FOOTER
         ============================== -->
    <!-- The mt-auto class forces the footer to the bottom -->
    <footer class="footer-custom mt-auto text-center text-md-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                        &copy; {{ date('Y') }} All rights reserved by EverestEngineering
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span
                        class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill"
                        style="font-size: 0.75rem; letter-spacing: 1px;">
                        <span class="spinner-grow spinner-grow-sm text-success me-1" style="width: 8px; height: 8px;"
                            role="status"></span>
                        MARS COMM LINK ACTIVE
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-Dismiss Alerts Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert-success, .alert-danger');
            alerts.forEach(function (alert) {
                setTimeout(function () {
                    alert.classList.add('fade-out');
                    setTimeout(function () {
                        alert.remove();
                    }, 500);
                }, 4000);
            });
        });
    </script>
</body>

</html>