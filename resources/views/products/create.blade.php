@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">Ajouter un produit</h1>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="mb-4">
                            <label for="name" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Nom *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="barcode" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Code-barres</label>
                            <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Catégorie *</label>
                            <select name="category_id" id="category_id"
                                    class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="supplier_id" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Fournisseur *</label>
                            <select name="supplier_id" id="supplier_id"
                                    class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                <option value="">Sélectionner un fournisseur</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="purchase_price" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Prix d'achat *</label>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="sale_price" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Prix de vente *</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" value="{{ old('sale_price') }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="stock_quantity" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Quantité en stock *</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', 0) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="alert_threshold" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Seuil d'alerte *</label>
                            <input type="number" name="alert_threshold" id="alert_threshold" value="{{ old('alert_threshold', 5) }}"
                                   class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>

                        <div class="col-span-1 mb-4 md:col-span-2">
                            <label for="description" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('products.index') }}"
                           class="rounded bg-gray-500 px-4 py-2 font-bold text-white transition hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-500">
                            Annuler
                        </a>
                        <button type="submit"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection