<div class="rounded-lg bg-white p-6 shadow dark:border dark:border-gray-700 dark:bg-gray-800">

    <!-- Header -->
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">Alertes Stock</h2>
        <span class="text-sm text-gray-500 dark:text-gray-400">Produits nécessitant attention</span>
    </div>

    <!-- Summary -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div class="rounded-lg bg-yellow-50 p-3 text-center dark:bg-yellow-900/20">
            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $lowStockCount }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300">Stock bas</p>
        </div>

        <div class="rounded-lg bg-red-50 p-3 text-center dark:bg-red-900/20">
            <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $outOfStockCount }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300">Rupture</p>
        </div>
    </div>

    <!-- STATUS MESSAGE (your new logic) -->
    @if($lowStockCount == 0 && $outOfStockCount == 0)
        <div class="mb-4 rounded-lg bg-green-100 p-3 text-center dark:bg-green-900/20">
            <p class="font-semibold text-green-700 dark:text-green-400">
                Tous les stocks sont bons
            </p>
        </div>
    @else
        <div class="mb-4 rounded-lg bg-red-100 p-3 text-center dark:bg-red-900/20">
            <p class="font-semibold text-red-700 dark:text-red-400">
                Attention : certains produits nécessitent un réapprovisionnement
            </p>
        </div>
    @endif

    <!-- List -->
    @if($lowStockProducts->count() > 0)
        <div class="mt-4">
            <h3 class="mb-2 font-semibold text-gray-700 dark:text-gray-200">
                Produits à réapprovisionner
            </h3>

            <div class="max-h-64 space-y-2 overflow-y-auto">
                @foreach($lowStockProducts as $product)
                    <div class="flex items-center justify-between rounded bg-gray-50 p-2 dark:bg-gray-700/40">
                        <div>
                            <p class="font-medium text-gray-800 dark:text-gray-100">
                                {{ $product->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $product->category->name ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm
                                @if($product->stock_quantity == 0)
                                    font-bold text-red-600 dark:text-red-400
                                @else
                                    text-yellow-600 dark:text-yellow-400
                                @endif
                            ">
                                Stock: {{ $product->stock_quantity }}
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Seuil: {{ $product->alert_threshold }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>