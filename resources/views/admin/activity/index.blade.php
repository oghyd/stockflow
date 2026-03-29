<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Activity Log</h2>
    </x-slot>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        @if($logs->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-50 dark:bg-gray-900/40">
                        <tr class="border-b border-gray-200 text-gray-600 dark:border-gray-700 dark:text-gray-300">
                            <th class="py-3 font-semibold text-gray-700 dark:text-gray-200">Date</th>
                            <th class="py-3 font-semibold text-gray-700 dark:text-gray-200">User</th>
                            <th class="py-3 font-semibold text-gray-700 dark:text-gray-200">Action</th>
                            <th class="py-3 font-semibold text-gray-700 dark:text-gray-200">Subject</th>
                            <th class="py-3 font-semibold text-gray-700 dark:text-gray-200">Description</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($logs as $log)
                            <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                <td class="py-3 text-gray-600 dark:text-gray-300">
                                    {{ $log->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td class="py-3 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $log->user->name ?? 'System' }}
                                </td>

                                <td class="py-3">
                                    <span class="inline-block rounded px-2 py-1 text-xs font-semibold
                                        @if($log->action === 'user_created')
                                            bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300
                                        @elseif($log->action === 'user_updated')
                                            bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300
                                        @elseif($log->action === 'user_deleted')
                                            bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300
                                        @else
                                            bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300
                                        @endif
                                    ">
                                        {{ str_replace('_', ' ', ucfirst($log->action)) }}
                                    </span>
                                </td>

                                <td class="py-3 text-gray-600 dark:text-gray-300">
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </td>

                                <td class="py-3 text-gray-700 dark:text-gray-300">
                                    {{ $log->description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-4 dark:border-gray-700">
                {{ $logs->links() }}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-400">No activity recorded yet.</p>
        @endif
    </div>
</x-app-layout>