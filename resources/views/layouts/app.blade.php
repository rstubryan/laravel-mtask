<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}

        @if(session('success'))
            <div class="fixed bottom-6 right-6 z-50">
                <x-aui::alert dismissOnTimeout timeout="2500">
                    <x-slot:icon>
                        <x-lucide-circle-check class="h-4 w-4"/>
                    </x-slot:icon>
                    <x-slot:title>Success!</x-slot:title>
                    <x-slot:description>
                        {{ session('success') }}
                    </x-slot:description>
                </x-aui::alert>
            </div>
        @endif

        @if(session('error'))
            <div class="fixed bottom-6 right-6 z-50">
                <x-aui::alert variant="destructive" dismissOnTimeout timeout="2500">
                    <x-slot:icon>
                        <x-lucide-triangle-alert class="h-4 w-4"/>
                    </x-slot:icon>
                    <x-slot:title>Failed!</x-slot:title>
                    <x-slot:description>
                        Action failed. Please try again.
                    </x-slot:description>
                </x-aui::alert>
            </div>
        @endif
    </main>
</div>
</body>
</html>
