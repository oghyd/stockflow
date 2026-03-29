<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <div class="border-b border-gray-200 px-6 py-4 text-center dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Users List</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Manage admins, vendeurs, and fournisseurs.
        </p>
    </div>

    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-center">
            <div>
                <label for="role" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300 text-center md:text-left">
                    Filter by role
                </label>
                <select
                    wire:model.live="role"
                    id="role"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 md:w-52"
                >
                    <option value="">All roles</option>
                    <option value="admin">Administrator</option>
                    <option value="fournisseur">Fournisseur</option>
                    <option value="vendeur">Vendeur</option>
                </select>
            </div>

            <div>
                <label for="search" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300 text-center md:text-left">
                    Search by name or email
                </label>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    id="search"
                    placeholder="Enter name or email..."
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 md:w-72"
                >
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 dark:bg-gray-900/40">
                <tr>
                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">Name</th>
                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">Email</th>
                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">Role</th>
                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-200">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                    @php
                        $userRole = $user->getRoleNames()->first();
                    @endphp

                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-gray-100">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($userRole === 'admin')
                                <span class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">
                                    Administrator
                                </span>
                            @elseif($userRole === 'vendeur')
                                <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    Vendeur
                                </span>
                            @elseif($userRole === 'fournisseur')
                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    Fournisseur
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    No Role
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="font-medium text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="font-medium text-red-600 transition hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
        {{ $users->links() }}
    </div>
</div>