@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">Modifier le produit</h1>

                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="mb-4">
                            <label for="name" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Nom *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

<div class="mb-4">
    <label for="barcode" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Code-barres *</label>
    <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $product->barcode) }}" 
           class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
           required>
    @error('barcode')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


                        <div class="mb-4">
                            <label for="category_id" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Catégorie *</label>
                            <select name="category_id" id="category_id"
                                    class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="supplier_id" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Fournisseur *</label>
                            <select name="supplier_id" id="supplier_id"
                                    class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="purchase_price" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Prix d'achat *</label>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="sale_price" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Prix de vente *</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="stock_quantity" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Quantité en stock *</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="alert_threshold" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Seuil d'alerte *</label>
                            <input type="number" name="alert_threshold" id="alert_threshold" value="{{ old('alert_threshold', $product->alert_threshold) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="col-span-1 mb-4 md:col-span-2">
                            <label for="description" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('products.index') }}"
                           class="rounded bg-gray-500 px-4 py-2 font-bold text-white transition hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">
                            Annuler
                        </a>
                        <button type="submit"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection