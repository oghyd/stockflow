<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index()
    {
        $query = Sale::with(['user', 'saleItems'])->latest();

        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        $sales = $query->paginate(10);

        return view('sales.history', compact('sales'));
    }

    public function show(Sale $sale)
    {
        if (!Auth::user()->hasRole('admin') && $sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load(['user', 'saleItems.product']);

        return view('sales.show', compact('sale'));
    }

    public function receipt(Sale $sale)
    {
        if (!Auth::user()->hasRole('admin') && $sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load(['user', 'saleItems.product']);

        return view('pdf.receipt', compact('sale'));
    }

    public function downloadReceipt(Sale $sale)
    {
        if (!Auth::user()->hasRole('admin') && $sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load(['user', 'saleItems.product']);

        $pdf = Pdf::loadView('pdf.receipt', compact('sale'));

        return $pdf->download('receipt-sale-' . $sale->id . '.pdf');
    }

    public function logValidatedSale(Sale $sale): void
    {
        $sale->load(['saleItems.product']);

        $itemsSummary = $sale->saleItems
            ->map(function ($item) {
                return $item->product->name . ' x' . $item->quantity;
            })
            ->implode(', ');

        Loggable::recordActivity(
            'sale_validated',
            $sale,
            'Sale #' . $sale->id . ' validated. Total: ' . $sale->total_ttc . ' MAD. Items: ' . $itemsSummary
        );
    }
}