<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vente #{{ $sale->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p><strong>Vendeur:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
                <p><strong>Total TTC:</strong> {{ number_format($sale->total_ttc, 2) }} DH</p>
                <p><strong>Date:</strong> {{ $sale->validated_at ?? $sale->created_at }}</p>

                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Articles</h3>

                    @forelse($sale->saleItems as $item)
                        <div class="border-b py-2">
                            <div>Produit ID: {{ $item->product_id }}</div>
                            <div>Quantité: {{ $item->quantity }}</div>
                            <div>Prix unitaire: {{ number_format($item->unit_price, 2) }} DH</div>
                            <div>Sous-total: {{ number_format($item->subtotal, 2) }} DH</div>
                        </div>
                    @empty
                        <p>Aucun article pour cette vente.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    <a href="{{ route('sales.receipt', $sale) }}" class="underline">
                        Voir le reçu
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
