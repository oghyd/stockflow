<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function export()
    {
        $products = Product::whereColumn('stock_quantity', '<=', 'alert_threshold')
            ->with(['category', 'supplier'])
            ->get();

        $pdf = Pdf::loadView('pdf.stock-report', [
            'products' => $products,
            'date' => now()->format('d/m/Y H:i'),
        ]);

        return $pdf->download('rapport_stock_bas_' . now()->format('Y-m-d') . '.pdf');
    }
}