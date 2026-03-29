<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT SIDE -->
    <div class="lg:col-span-2">

        <!-- SEARCH -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                Recherche de produits
            </h3>

            @if (session()->has('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-700 dark:bg-green-900/20 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Rechercher un produit..."
                    class="w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm
                           dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                >
            </div>

            <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-700/40 space-y-2">
                @forelse($this->products as $product)
                    <div class="flex items-center justify-between border-b pb-2 dark:border-gray-600">
                        <div>
                            <div class="font-medium text-gray-900 dark:text-gray-100">
                                {{ $product->name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
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
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Aucun produit trouvé.
                    </p>
                @endforelse
            </div>
        </div>

        <!-- CART -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                Panier
            </h3>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-900/40">
                        <tr>
                            <th class="px-4 py-2 text-left border text-gray-700 dark:text-gray-200 dark:border-gray-700">Produit</th>
                            <th class="px-4 py-2 text-left border text-gray-700 dark:text-gray-200 dark:border-gray-700">Prix</th>
                            <th class="px-4 py-2 text-left border text-gray-700 dark:text-gray-200 dark:border-gray-700">Quantité</th>
                            <th class="px-4 py-2 text-left border text-gray-700 dark:text-gray-200 dark:border-gray-700">Sous-total</th>
                            <th class="px-4 py-2 text-left border text-gray-700 dark:text-gray-200 dark:border-gray-700">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($this->cartItems as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                <td class="px-4 py-2 border text-gray-900 dark:text-gray-100 dark:border-gray-700">
                                    {{ $item['name'] }}
                                </td>

                                <td class="px-4 py-2 border text-gray-700 dark:text-gray-300 dark:border-gray-700">
                                    {{ number_format($item['unit_price'], 2) }} DH
                                </td>

                                <td class="px-4 py-2 border dark:border-gray-700">
                                    <input
                                        type="number"
                                        min="1"
                                        value="{{ $item['quantity'] }}"
                                        wire:change="updateQuantity({{ $item['product_id'] }}, $event.target.value)"
                                        class="w-20 rounded-md border-gray-300 bg-white text-gray-900 shadow-sm
                                               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                    >
                                </td>

                                <td class="px-4 py-2 border text-gray-700 dark:text-gray-300 dark:border-gray-700">
                                    {{ number_format($item['subtotal'], 2) }} DH
                                </td>

                                <td class="px-4 py-2 border dark:border-gray-700">
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
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 border dark:border-gray-700">
                                    Aucun produit dans le panier.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 sticky top-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
                Résumé de la vente
            </h3>

            <div class="space-y-3">
                <div class="flex justify-between text-gray-600 dark:text-gray-300">
                    <span>Articles</span>
                    <span class="font-medium">{{ $this->itemsCount }}</span>
                </div>

                <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-gray-100">
                    <span>Total</span>
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