<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StockFlow') }}</title>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex">
        @auth
            @include('layouts.navigation')
        @endauth

        <div class="flex-1 flex min-w-0 flex-col">
            @auth
                <header class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $header ?? 'Dashboard' }}
                            </h1>
                        </div>

                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                </header>
            @endauth

            <main class="flex-1 flex justify-center p-6">
                <div class="w-full max-w-7xl">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>

    @livewireScripts
</body>
</html>