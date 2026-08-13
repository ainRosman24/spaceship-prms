<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Spaceship X26') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%2306b6d4'>🚀</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Spaceship Login CSS -->
        <link href="{{ asset('css/spaceship-login.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="min-h-screen">
            <div class="spaceship-container">
                <div class="spaceship-header">
                    <div class="spaceship-logo">Spaceship X26</div>
                    <div class="spaceship-tagline">Passenger Resource Management System</div>
                    <div class="mission-info">
                        <span>Earth</span>
                        <span>→</span>
                        <span>Mars</span>
                        <span>|</span>
                        <span>Settlement Mission</span>
                    </div>
                </div>

                <div class="login-card">

                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>