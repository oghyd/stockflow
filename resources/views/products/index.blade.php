<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Produits</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage all store products.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Produits</h1>

                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('fournisseur'))
                            <a href="{{ route('products.create') }}"
                               class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                                + Nouveau produit
                            </a>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 dark:border-green-700 dark:bg-green-900/30 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 dark:border-red-700 dark:bg-red-900/30 dark:text-red-300">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Filters -->
                    <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900/30">
                        <form method="GET" action="{{ route('products.index') }}"
                              class="grid grid-cols-1 gap-4 md:grid-cols-4">

                            <div>
                                <label for="search" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Rechercher par nom
                                </label>
                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nom du produit..."
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-400"
                                >
                            </div>

                            <div>
                                <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Filtrer par catégorie
                                </label>
                                <select
                                    name="category_id"
                                    id="category_id"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                                >
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="supplier_id" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Filtrer par fournisseur
                                </label>
                                <select
                                    name="supplier_id"
                                    id="supplier_id"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                                >
                                    <option value="">Tous les fournisseurs</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-end gap-2">
                                <button type="submit"
                                        class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                                    Filtrer
                                </button>

                                <a href="{{ route('products.index') }}"
                                   class="rounded bg-gray-500 px-4 py-2 font-bold text-white transition hover:bg-gray-600">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-900/40">
                                32
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">ID</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Nom</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Catégorie</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Fournisseur</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Prix achat</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Prix vente</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Stock</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Seuil alerte</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Code-barres</th>
                                    <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Actions</th>
                                 </tr>
                            </thead>

                            <tbody>
                                @forelse($products as $product)
                                    @php
                                        $user = auth()->user();
                                        $canEdit = false;
                                        
                                        if ($user->hasRole('admin')) {
                                            $canEdit = true;
                                        } elseif ($user->hasRole('fournisseur')) {
                                            $supplier = \App\Models\Supplier::where('user_id', $user->id)->first();
                                            if ($supplier && $product->supplier_id == $supplier->id) {
                                                $canEdit = true;
                                            }
                                        }
                                    @endphp
                                    
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
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
                                            {{ number_format($product->purchase_price, 2) }}
                                        </td>

                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ number_format($product->sale_price, 2) }}
                                        </td>

                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $product->stock_quantity }}
                                        </td>

                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $product->alert_threshold }}
                                        </td>

                                        <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                            {{ $product->barcode ?? '—' }}
                                        </td>

                                        <td class="border border-gray-200 px-4 py-2 dark:border-gray-700">
                                            @if($canEdit)
                                                <a href="{{ route('products.edit', $product) }}"
                                                   class="mr-3 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Modifier
                                                </a>

                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Supprimer ce produit ?')">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="border border-gray-200 px-4 py-2 text-center text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                            Aucun produit trouvé avec ces filtres.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>