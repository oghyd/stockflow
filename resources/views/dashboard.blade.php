@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Widget Alertes Stock -->
            <div class="lg:col-span-2">
                @livewire('dashboard.low-stock-widget')
            </div>

            <!-- Autres widgets (à ajouter plus tard) -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Bienvenue</h2>
                <p class="text-gray-600">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500 mt-2">Rôle: {{ Auth::user()->getRoleNames()->implode(', ') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection