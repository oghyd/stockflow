@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Mes produits</h1>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Nom</th>
                                <th class="border px-4 py-2">Catégorie</th>
                                <th class="border px-4 py-2">Prix vente</th>
                                <th class="border px-4 py-2">Stock</th>
                                <th class="border px-4 py-2">Seuil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="{{ $product->stock_quantity <= $product->alert_threshold ? 'bg-yellow-50' : '' }}">
                                <td class="border px-4 py-2">{{ $product->id }}</td>
                                <td class="border px-4 py-2 font-semibold">{{ $product->name }}</td>
                                <td class="border px-4 py-2">{{ $product->category->name ?? '—' }}</td>
                                <td class="border px-4 py-2">{{ number_format($product->sale_price, 2) }} DH</td>
                                <td class="border px-4 py-2">
                                    <span class="{{ $product->stock_quantity == 0 ? 'text-red-600 font-bold' : ($product->stock_quantity <= $product->alert_threshold ? 'text-yellow-600' : 'text-green-600') }}">
                                        {{ $product->stock_quantity }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">{{ $product->alert_threshold }}</td>
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
    </div>
</div>
@endsection