<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                Admin Dashboard
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Overview of your system
            </p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6">

        <!-- STATS -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $totalUsers }}
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Admins</p>
                <p class="mt-2 text-3xl font-bold text-purple-600 dark:text-purple-300">
                    {{ $totalAdmins }}
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Vendeurs</p>
                <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-300">
                    {{ $totalVendeurs }}
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Fournisseurs</p>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-300">
                    {{ $totalFournisseurs }}
                </p>
            </div>

        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            <!-- ACTIVITY -->
            <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Recent Activity
                    </h3>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentActivities as $activity)
                        <div class="px-6 py-4">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $activity->user->name ?? 'System' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $activity->description }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity->created_at->format('Y-m-d H:i') }}
                            </p>
                        </div>
                    @empty
                        <div class="p-6 text-gray-500 dark:text-gray-400">
                            No activity yet
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- LOW STOCK -->
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Stock Alerts
                    </h3>
                </div>

                <div class="p-6">
                    <livewire:dashboard.low-stock-widget />
                </div>
            </div>

        </div>

    </div>
</x-app-layout>