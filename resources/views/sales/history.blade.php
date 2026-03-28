<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historique des ventes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse($sales as $sale)
                    <div class="border-b py-3">
                        <a href="{{ route('sales.show', $sale) }}" class="font-semibold underline">
                            Vente #{{ $sale->id }}
                        </a>
                        <div>Total TTC: {{ number_format($sale->total_ttc, 2) }} DH</div>
                        <div>Vendeur: {{ $sale->user->name ?? 'N/A' }}</div>
                        <div>Date: {{ $sale->validated_at ?? $sale->created_at }}</div>
                    </div>
                @empty
                    <p>Aucune vente trouvée.</p>
                @endforelse

                <div class="mt-4">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
