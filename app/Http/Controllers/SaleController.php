<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

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

        $sale->load(['user', 'saleItems']);

        return view('sales.show', compact('sale'));
    }

    public function receipt(Sale $sale)
    {
        if (!Auth::user()->hasRole('admin') && $sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load(['user', 'saleItems']);

        return view('pdf.receipt', compact('sale'));
    }
}
