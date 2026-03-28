<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Activity Log</h2>
    </x-slot>

    <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-6">
        @if($logs->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="py-3">Date</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Action</th>
                            <th class="py-3">Subject</th>
                            <th class="py-3">Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                            <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">
                                <td class="py-3 text-gray-600">
                                    {{ $log->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td class="py-3">
                                    {{ $log->user->name ?? 'System' }}
                                </td>

                                <td class="py-3">
                                    <span class="inline-block rounded px-2 py-1 text-xs font-semibold
                                        @if($log->action === 'user_created') bg-green-100 text-green-700
                                        @elseif($log->action === 'user_updated') bg-blue-100 text-blue-700
                                        @elseif($log->action === 'user_deleted') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-700
                                        @endif
                                    ">
                                        {{ str_replace('_', ' ', ucfirst($log->action)) }}
                                    </span>
                                </td>
                                
                                <td class="py-3 text-gray-600">
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </td>

                                <td class="py-3 text-gray-700">
                                    {{ $log->description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        @else
            <p class="text-gray-600">No activity recorded yet.</p>
        @endif
    </div>
</x-app-layout>