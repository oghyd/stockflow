<div>
    <div class="rounded-lg bg-white p-6 shadow dark:border dark:border-gray-700 dark:bg-gray-800">
        <h2 class="mb-4 text-lg font-bold text-gray-800 dark:text-gray-100">Recherche de produits</h2>

        <!-- Filtres -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-4">
            <div>
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Rechercher par nom ou code-barres..."
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                >
            </div>

            <div>
                <select
                    wire:model.live="category_id"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                >
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select
                    wire:model.live="supplier_id"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                >
                    <option value="">Tous les fournisseurs</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button
                    wire:click="resetFilters"
                    class="w-full rounded bg-gray-500 px-4 py-2 font-bold text-white transition hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500"
                >
                    Réinitialiser
                </button>
            </div>
        </div>

        <!-- Résultats -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-900/40">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">ID</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Nom</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Catégorie</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Fournisseur</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Prix vente</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Stock</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr class="
                        @if($product->stock_quantity == 0)
                            bg-red-50 dark:bg-red-900/20
                        @elseif($product->stock_quantity <= $product->alert_threshold)
                            bg-yellow-50 dark:bg-yellow-900/20
                        @else
                            hover:bg-gray-50 dark:hover:bg-gray-700/40
                        @endif
                    ">
                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                            {{ $product->id }}
                        </td>

                        <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-900 dark:border-gray-700 dark:text-gray-100">
                            {{ $product->name }}
                        </td>

                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                            {{ $product->category->name ?? '—' }}
                        </td>

                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                            {{ $product->supplier->name ?? '—' }}
                        </td>

                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                            {{ number_format($product->sale_price, 2) }} DH
                        </td>

                        <td class="border border-gray-200 px-4 py-2 dark:border-gray-700">
                            <span class="
                                @if($product->stock_quantity == 0)
                                    font-bold text-red-600 dark:text-red-400
                                @elseif($product->stock_quantity <= $product->alert_threshold)
                                    text-yellow-600 dark:text-yellow-400
                                @else
                                    text-green-600 dark:text-green-400
                                @endif
                            ">
                                {{ $product->stock_quantity }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="border border-gray-200 px-4 py-2 text-center text-gray-500 dark:border-gray-700 dark:text-gray-400">
                            Aucun produit trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>