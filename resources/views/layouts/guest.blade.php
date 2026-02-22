<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MovieApp') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="margin:0; padding:0; min-height:100%; background:#0f172a;">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <a href="/" class="auth-brand">MovieApp</a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
