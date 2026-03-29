@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">Mes produits</h1>

                @if(session('success'))
                    <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 dark:border-green-700 dark:bg-green-900/30 dark:text-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-900/40">
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">ID</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Nom</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Catégorie</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Prix vente</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Stock</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Seuil</th>
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
                                <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                    {{ $product->alert_threshold }}
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
    </div>
</div>
@endsection