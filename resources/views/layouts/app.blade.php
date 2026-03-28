<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StockFlow') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">
    <div class="min-h-screen flex">
        @auth
            @include('layouts.navigation')
        @endauth

        <div class="flex-1 flex flex-col min-w-0">
            @auth
                <header class="bg-white border-b border-gray-200">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-semibold">
                                {{ $header ?? 'Dashboard' }}
                            </h1>
                        </div>

                        <div class="text-sm text-gray-600">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                </header>
            @endauth

            <main class="flex-1 p-6 flex justify-center">
                <div class="w-full max-w-7xl">
                    {{ $slot ?? '' }}

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>