@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:border dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Catégories</h1>
                    <a href="{{ route('categories.create') }}"
                       class="rounded bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                        + Nouvelle catégorie
                    </a>
                </div>

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
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Description</th>
                                <th class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">{{ $category->id }}</td>
                                <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-900 dark:border-gray-700 dark:text-gray-100">{{ $category->name }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-gray-700 dark:border-gray-700 dark:text-gray-300">{{ $category->description ?? '—' }}</td>
                                <td class="border border-gray-200 px-4 py-2 dark:border-gray-700">
                                    <a href="{{ route('categories.edit', $category) }}" class="mr-3 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Modifier</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                onclick="return confirm('Supprimer cette catégorie ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border border-gray-200 px-4 py-2 text-center text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                    Aucune catégorie trouvée. Cliquez sur "Nouvelle catégorie" pour commencer.
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