<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Détails de la vente #{{ $sale->id }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6">
                        <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Vendeur :</strong> {{ $sale->user->name ?? '—' }}</p>
                        <p><strong>Total TTC :</strong> {{ number_format($sale->total_ttc, 2) }} DH</p>
                    </div>

                    <h3 class="text-lg font-bold mb-4">Produits vendus</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-900/40">
                                <tr>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Produit</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Prix unitaire</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Quantité</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->saleItems as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $item->product->name ?? '—' }}
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ number_format($item->unit_price, 2) }} DH
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ number_format($item->subtotal, 2) }} DH
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('sales.index') }}" 
                           class="rounded bg-gray-500 px-4 py-2 font-bold text-white transition hover:bg-gray-700">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>