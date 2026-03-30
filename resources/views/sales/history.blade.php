<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            Historique des ventes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-900">
                @forelse($sales as $sale)
                    <div class="mb-6 rounded-2xl bg-slate-950 px-8 py-6 text-white shadow-lg">
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold">
                                Vente #{{ $sale->id }}
                            </h3>

                            <p class="text-2xl font-semibold">
                                Total TTC: {{ number_format($sale->total_ttc, 2) }} DH
                            </p>

                            <p class="text-2xl font-medium">
                                Vendeur: {{ $sale->user->name ?? 'N/A' }}
                            </p>

                            <p class="text-2xl font-medium">
                                Date: {{ \Carbon\Carbon::parse($sale->validated_at ?? $sale->created_at)->format('Y-m-d H:i:s') }}
                            </p>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-4">
                            <a
                                href="{{ route('sales.show', $sale) }}"
                                class="inline-flex items-center rounded-2xl bg-blue-600 px-8 py-4 text-2xl font-medium text-white transition hover:bg-blue-700"
                            >
                                Voir détails
                            </a>

                            <a
                                href="{{ route('sales.receipt.download', $sale) }}"
                                class="inline-flex items-center rounded-2xl bg-green-500 px-8 py-4 text-2xl font-medium text-white transition hover:bg-green-600"
                            >
                                Télécharger reçu PDF
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-gray-300 px-6 py-8 text-center text-gray-500 dark:border-gray-700 dark:text-gray-400">
                        Aucune vente trouvée.
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>