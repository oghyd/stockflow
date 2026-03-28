<aside class="w-64 min-h-screen bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo / Brand -->
    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
            <span class="text-lg font-bold text-gray-900">StockFlow</span>
        </a>
    </div>

    <!-- User Info -->
    <div class="px-6 py-4 border-b border-gray-100">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Connected as</p>
        <p class="mt-1 text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
        <p class="text-sm text-gray-500">{{ Auth::user()->getRoleNames()->implode(', ') ?: 'No role' }}</p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
        <!-- General -->
        <div class="space-y-1">
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400">General</p>

            <a href="{{ route('dashboard') }}"
               class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
               {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                Dashboard
            </a>
        </div>

        <!-- Admin -->
       <!-- Admin -->
       @role('admin')
    <div class="space-y-1">
        <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400">Admin</p>

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Users
        </a>

        <a href="{{ route('admin.activity.index') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('admin.activity.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Activity Log
        </a>

        <a href="{{ route('products.index') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Products
        </a>

        <a href="{{ route('categories.index') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Categories
        </a>

        <a href="{{ route('suppliers.index') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('suppliers.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Suppliers
        </a>

        <a href="{{ route('stock.report') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('stock.report') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Rapport Stock Bas
        </a>
    </div>
@endrole

        <!-- Vendeur -->
        @role('vendeur')
            <div class="space-y-1">
                <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400">Vendeur</p>

                <a href="#"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed">
                    Caisse
                </a>

                <a href="#"
                   class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed">
                    Sales History
                </a>
            </div>
        @endrole

        <!-- Fournisseur -->
       <!-- Fournisseur -->
@role('fournisseur')
    <div class="space-y-1">
        <p class="px-3 text-xs font-semibold uppercase tracking-wide text-gray-400">Fournisseur</p>

        <a href="{{ route('fournisseur.stock') }}"
           class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition
           {{ request()->routeIs('fournisseur.stock') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            Mon Stock
        </a>
    </div>
@endrole
    </nav>

    <!-- Bottom actions -->
    <div class="p-4 border-t border-gray-100">
        <a href="{{ route('profile.edit') }}"
           class="mb-2 flex items-center rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition">
                Log Out
            </button>
        </form>
    </div>
</aside>