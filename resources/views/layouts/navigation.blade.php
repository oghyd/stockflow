<aside class="flex min-h-screen w-64 flex-col border-r border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
    <!-- Logo / Brand -->
    <div class="flex h-16 items-center border-b border-gray-100 px-6 dark:border-gray-700">
        <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3">
            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-100" />
            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">StockFlow</span>
        </a>
    </div>

    <!-- User Info -->
    <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
            Connected as
        </p>
        <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100">
            {{ Auth::user()->name }}
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ Auth::user()->getRoleNames()->implode(', ') ?: 'No role' }}
        </p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-8 overflow-y-auto px-4 py-6">
        <!-- General -->
        <div class="space-y-1">
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                General
            </p>

            <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('dashboard') }}"
               class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
               {{ request()->routeIs('admin.dashboard')
                    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                    : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                Dashboard
            </a>
        </div>

        <!-- Admin -->
        @role('admin')
            <div class="space-y-1">
                <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                    Admin
                </p>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('admin.users.*')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Users
                </a>

                <a href="{{ route('admin.activity.index') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('admin.activity.*')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Activity Log
                </a>

                <a href="{{ route('products.index') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('products.*')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Products
                </a>

                <a href="{{ route('categories.index') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('categories.*')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Categories
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('suppliers.*')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Suppliers
                </a>

                <a href="{{ route('stock.report') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('stock.report')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Rapport Stock Bas
                </a>
            </div>
        @endrole

        <!-- Vendeur -->
        @role('vendeur')
            <div class="space-y-1">
                <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                    Vendeur
                </p>

                <a href="#"
                   class="flex cursor-not-allowed items-center rounded-lg bg-gray-50 px-3 py-2.5 text-sm font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                    Caisse
                </a>

                <a href="#"
                   class="flex cursor-not-allowed items-center rounded-lg bg-gray-50 px-3 py-2.5 text-sm font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                    Sales History
                </a>
            </div>
        @endrole

        <!-- Fournisseur -->
        @role('fournisseur')
            <div class="space-y-1">
                <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                    Fournisseur
                </p>

                <a href="{{ route('fournisseur.stock') }}"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
                   {{ request()->routeIs('fournisseur.stock')
                        ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                    Mon Stock
                </a>
            </div>
        @endrole
    </nav>

    <!-- Bottom actions -->
    <div class="space-y-2 border-t border-gray-100 p-4 dark:border-gray-700">
        <a href="{{ route('profile.edit') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
            Profile
        </a>

        <button
            type="button"
            onclick="toggleTheme()"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700"
        >
            Toggle Theme
        </button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700">
                Log Out
            </button>
        </form>
    </div>
</aside>