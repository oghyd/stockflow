@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Produits</h1>
                    <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Nouveau produit
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Catégorie</th>
                            <th class="border px-4 py-2">Fournisseur</th>
                            <th class="border px-4 py-2">Prix Achat</th>
                            <th class="border px-4 py-2">Prix Vente</th>
                            <th class="border px-4 py-2">Stock</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="{{ $product->stock_quantity <= $product->alert_threshold ? 'bg-yellow-50' : '' }}">
                            <td class="border px-4 py-2">{{ $product->id }}</td>
                            <td class="border px-4 py-2 font-semibold">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->category->name ?? '—' }}</td>
                            <td class="border px-4 py-2">{{ $product->supplier->name ?? '—' }}</td>
                            <td class="border px-4 py-2">{{ number_format($product->purchase_price, 2) }} DH</td>
                            <td class="border px-4 py-2">{{ number_format($product->sale_price, 2) }} DH</td>
                            <td class="border px-4 py-2">
                                <span class="{{ $product->stock_quantity == 0 ? 'text-red-600 font-bold' : ($product->stock_quantity <= $product->alert_threshold ? 'text-yellow-600' : 'text-green-600') }}">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce produit ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="border px-4 py-2 text-center text-gray-500">
                                Aucun produit trouvé. Cliquez sur "Nouveau produit" pour commencer.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection