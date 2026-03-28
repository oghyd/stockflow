<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Users</h2>
            <p class="mt-1 text-sm text-gray-500">Manage admins, vendeurs, and fournisseurs.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-5xl">
        <div class="mb-6 flex justify-center">
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center rounded-lg border border-gray-800 bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm transition hover:bg-gray-100">
                + Create User
            </a>
        </div>

        <livewire:admin.user-table />
    </div>
</x-app-layout>