<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-gray-800">Alertes Stock</h2>
        <span class="text-sm text-gray-500">Produits nécessitant attention</span>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="bg-yellow-50 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $lowStockCount }}</p>
            <p class="text-sm text-gray-600">Stock bas</p>
        </div>
        <div class="bg-red-50 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $outOfStockCount }}</p>
            <p class="text-sm text-gray-600">Rupture</p>
        </div>
    </div>

    @if($lowStockProducts->count() > 0)
        <div class="mt-4">
            <h3 class="font-semibold text-gray-700 mb-2">Produits à réapprovisionner</h3>
            <div class="space-y-2 max-h-64 overflow-y-auto">
                @foreach($lowStockProducts as $product)
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                        <div>
                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">{{ $product->category->name ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm {{ $product->stock_quantity == 0 ? 'text-red-600 font-bold' : 'text-yellow-600' }}">
                                Stock: {{ $product->stock_quantity }}
                            </p>
                            <p class="text-xs text-gray-500">Seuil: {{ $product->alert_threshold }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-4 text-gray-500">
            ✅ Tous les stocks sont bons
        </div>
    @endif
</div>