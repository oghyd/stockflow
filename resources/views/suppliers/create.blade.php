@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">Ajouter un fournisseur</h1>

                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Nom *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full rounded border border-gray-300 px-3 py-2 @error('name') border-red-500 @enderror bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Téléphone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                               class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="mb-2 block font-bold text-gray-700 dark:text-gray-300">Adresse</label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full rounded border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">{{ old('address') }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('suppliers.index') }}"
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