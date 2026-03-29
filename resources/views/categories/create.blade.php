@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">Ajouter une catégorie</h1>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Nom de la catégorie *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full rounded border border-gray-300 px-3 py-2 @error('name') border-red-500 @enderror bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Ex: Électronique, Vêtements, etc." required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                  placeholder="Description optionnelle de la catégorie...">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('categories.index') }}"
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