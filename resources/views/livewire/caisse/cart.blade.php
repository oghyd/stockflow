<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Recherche de produits</h3>

            @if (session()->has('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Rechercher un produit par nom ou code-barres..."
                    class="w-full border-gray-300 rounded-md shadow-sm"
                >
            </div>

            <div class="border rounded-lg p-4 bg-gray-50 space-y-2">
                @forelse($this->products as $product)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <div class="font-medium">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ number_format($product->sale_price, 2) }} DH | Stock: {{ $product->stock_quantity }}
                            </div>
                        </div>

                        <button
                            wire:click="addProduct({{ $product->id }})"
                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                        >
                            Ajouter
                        </button>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Aucun produit trouvé.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Panier</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left border">Produit</th>
                            <th class="px-4 py-2 text-left border">Prix Unitaire</th>
                            <th class="px-4 py-2 text-left border">Quantité</th>
                            <th class="px-4 py-2 text-left border">Sous-total</th>
                            <th class="px-4 py-2 text-left border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->cartItems as $item)
                            <tr>
                                <td class="px-4 py-2 border">{{ $item['name'] }}</td>
                                <td class="px-4 py-2 border">{{ number_format($item['unit_price'], 2) }} DH</td>
                                <td class="px-4 py-2 border">
                                    <input
                                        type="number"
                                        min="1"
                                        value="{{ $item['quantity'] }}"
                                        wire:change="updateQuantity({{ $item['product_id'] }}, $event.target.value)"
                                        class="w-20 border-gray-300 rounded-md shadow-sm"
                                    >
                                </td>
                                <td class="px-4 py-2 border">{{ number_format($item['subtotal'], 2) }} DH</td>
                                <td class="px-4 py-2 border">
                                    <button
                                        wire:click="removeItem({{ $item['product_id'] }})"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                    >
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500 border">
                                    Aucun produit dans le panier pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-6">
            <h3 class="text-lg font-semibold mb-4">Résumé de la vente</h3>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nombre d’articles</span>
                    <span class="font-medium">{{ $this->itemsCount }}</span>
                </div>

                <div class="flex justify-between text-lg font-bold">
                    <span>Total TTC</span>
                    <span>{{ number_format($this->totalTtc, 2) }} DH</span>
                </div>
            </div>

            <button
                wire:click="validateSale"
                class="w-full mt-6 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 disabled:opacity-50"
                @disabled(empty($this->cartItems))
            >
                Valider la vente
            </button>
        </div>
    </div>
</div>
