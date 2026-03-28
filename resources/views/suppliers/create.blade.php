@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Ajouter un fournisseur</h1>

                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nom *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="w-full border border-gray-300 rounded px-3 py-2 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Téléphone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                               class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Adresse</label>
                        <textarea name="address" id="address" rows="3" 
                                  class="w-full border border-gray-300 rounded px-3 py-2">{{ old('address') }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('suppliers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Annuler
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection