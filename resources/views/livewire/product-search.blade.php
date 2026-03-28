<div>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Recherche de produits</h2>

        <!-- Filtres -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div>
                <input type="text" wire:model.live="search" placeholder="Rechercher par nom ou code-barres..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <select wire:model.live="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="supplier_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Tous les fournisseurs</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button wire:click="resetFilters" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Réinitialiser
                </button>
            </div>
        </div>

        <!-- Résultats -->
        <div class="overflow-x-auto">
            <table class="min-w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Catégorie</th>
                        <th class="border px-4 py-2">Fournisseur</th>
                        <th class="border px-4 py-2">Prix vente</th>
                        <th class="border px-4 py-2">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="{{ $product->stock_quantity <= $product->alert_threshold ? 'bg-yellow-50' : '' }}">
                        <td class="border px-4 py-2">{{ $product->id }}</td>
                        <td class="border px-4 py-2 font-semibold">{{ $product->name }}</td>
                        <td class="border px-4 py-2">{{ $product->category->name ?? '—' }}</td>
                        <td class="border px-4 py-2">{{ $product->supplier->name ?? '—' }}</td>
                        <td class="border px-4 py-2">{{ number_format($product->sale_price, 2) }} DH</td>
                        <td class="border px-4 py-2">
                            <span class="{{ $product->stock_quantity == 0 ? 'text-red-600 font-bold' : ($product->stock_quantity <= $product->alert_threshold ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ $product->stock_quantity }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center text-gray-500">
                            Aucun produit trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>