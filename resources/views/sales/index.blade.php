<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Historique des ventes</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Liste de toutes les ventes effectuées</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if(session('success'))
                        <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 dark:border-green-700 dark:bg-green-900/30 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-900/40">
                                <tr>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">ID Vente</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Date</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Vendeur</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Total TTC</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            #{{ $sale->id }}
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $sale->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $sale->user->name ?? '—' }}
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ number_format($sale->total_ttc, 2) }} DH
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 dark:border-gray-700">
                                            <a href="{{ route('sales.show', $sale) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Voir détails
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border border-gray-200 px-4 py-2 text-center text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                            Aucune vente trouvée.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($sales, 'links'))
    <div class="mt-4">
        {{ $sales->links() }}
    </div>
@endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>