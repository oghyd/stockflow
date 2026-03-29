<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit User</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update user information and role.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl">
        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-300">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}"
              class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input name="email"
                       type="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                <select name="role"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 focus:border-indigo-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ old('role', $user->getRoleNames()->first()) === $role->name ? 'selected' : '' }}>
                            {{ $role->name === 'admin' ? 'Administrator' : ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-center gap-3 pt-2">
                <button type="submit"
                        class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Update User
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>