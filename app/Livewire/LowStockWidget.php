<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class LowStockWidget extends Component
{
    public function render()
    {
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'alert_threshold')
            ->with(['category', 'supplier'])
            ->get();

        $outOfStockCount = Product::where('stock_quantity', 0)->count();
        $lowStockCount = $lowStockProducts->count();

        return view('livewire.low-stock-widget', [
            'lowStockProducts' => $lowStockProducts,
            'lowStockCount' => $lowStockCount,
            'outOfStockCount' => $outOfStockCount,
        ]);
    }
}