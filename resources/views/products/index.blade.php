@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Produits</h1>
            <a href="{{ route('products.create') }}"
               class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition hover:bg-blue-700">
                + Nouveau produit
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 dark:border-green-700 dark:bg-green-900/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @livewire('products.product-search')
    </div>
</div>
@endsection