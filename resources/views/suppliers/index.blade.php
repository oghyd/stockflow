@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Fournisseurs</h1>
                    <a href="{{ route('suppliers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Nouveau fournisseur
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
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Téléphone</th>
                            <th class="border px-4 py-2">Adresse</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        <tr>
                            <td class="border px-4 py-2">{{ $supplier->id }}</td>
                            <td class="border px-4 py-2 font-semibold">{{ $supplier->name }}</td>
                            <td class="border px-4 py-2">{{ $supplier->email ?? '—' }}</td>
                            <td class="border px-4 py-2">{{ $supplier->phone ?? '—' }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($supplier->address, 30) ?? '—' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce fournisseur ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-2 text-center text-gray-500">
                                Aucun fournisseur trouvé. Cliquez sur "Nouveau fournisseur" pour commencer.
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