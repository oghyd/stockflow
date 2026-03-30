<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-100">
            Historique des ventes
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-3xl">
            <div class="space-y-4">
                @forelse($sales as $sale)
                    <div class="rounded-xl bg-slate-950 px-5 py-4 text-white shadow-md">
                        <div class="space-y-1">
                            <h3 class="text-base font-bold">
                                Vente #{{ $sale->id }}
                            </h3>

                            <p class="text-sm font-medium">
                                Total TTC: {{ number_format($sale->total_ttc, 2) }} DH
                            </p>

                            <p class="text-sm">
                                Vendeur: {{ $sale->user->name ?? 'N/A' }}
                            </p>

                            <p class="text-sm">
                                Date: {{ \Carbon\Carbon::parse($sale->validated_at ?? $sale->created_at)->format('Y-m-d H:i:s') }}
                            </p>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2">
                            <a
                                href="{{ route('sales.show', $sale) }}"
                                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700"
                            >
                                Voir détails
                            </a>

                            <a
                                href="{{ route('sales.receipt.download', $sale) }}"
                                class="inline-flex items-center rounded-lg bg-green-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-600"
                            >
                                Télécharger reçu PDF
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-dashed border-gray-300 px-5 py-6 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
                        Aucune vente trouvée.
                    </div>
                @endforelse

                <div class="pt-1">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>