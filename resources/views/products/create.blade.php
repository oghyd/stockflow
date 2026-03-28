@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Ajouter un produit</h1>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Nom *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="barcode" class="block text-gray-700 font-bold mb-2">Code-barres</label>
                            <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 font-bold mb-2">Catégorie *</label>
                            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="supplier_id" class="block text-gray-700 font-bold mb-2">Fournisseur *</label>
                            <select name="supplier_id" id="supplier_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">Sélectionner un fournisseur</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="purchase_price" class="block text-gray-700 font-bold mb-2">Prix d'achat *</label>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="sale_price" class="block text-gray-700 font-bold mb-2">Prix de vente *</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="stock_quantity" class="block text-gray-700 font-bold mb-2">Quantité en stock *</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', 0) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="alert_threshold" class="block text-gray-700 font-bold mb-2">Seuil d'alerte *</label>
                            <input type="number" name="alert_threshold" id="alert_threshold" value="{{ old('alert_threshold', 5) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4 col-span-2">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Annuler</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
