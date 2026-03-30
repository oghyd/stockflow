<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\Loggable;

class SaleController extends Controller
{
    use Loggable;

    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            // Admin voit toutes les ventes
            $sales = Sale::with(['user', 'saleItems.product'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } elseif ($user->hasRole('fournisseur')) {
            // Fournisseur voit les ventes de ses produits seulement
            $supplier = Supplier::where('user_id', $user->id)->first();
            
            if ($supplier) {
                $sales = Sale::whereHas('saleItems.product', function($query) use ($supplier) {
                    $query->where('supplier_id', $supplier->id);
                })
                ->with(['user', 'saleItems.product'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            } else {
                $sales = collect(); // Aucune vente
            }
        } elseif ($user->hasRole('vendeur')) {
            // Vendeur voit ses propres ventes
            $sales = Sale::where('user_id', $user->id)
                ->with(['user', 'saleItems.product'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            $sales = collect();
        }
        
        return view('sales.index', compact('sales'));
    }

    public function show(Sale $sale)
    {
        $user = auth()->user();
        
        // Vérifier les permissions selon le rôle
        if ($user->hasRole('fournisseur')) {
            $supplier = Supplier::where('user_id', $user->id)->first();
            if ($supplier) {
                // Vérifier que la vente contient au moins un produit du fournisseur
                $hasProducts = $sale->saleItems()->whereHas('product', function($query) use ($supplier) {
                    $query->where('supplier_id', $supplier->id);
                })->exists();
                
                if (!$hasProducts) {
                    abort(403, 'Vous ne pouvez pas voir cette vente.');
                }
            } else {
                abort(403, 'Fournisseur non trouvé.');
            }
        } elseif ($user->hasRole('vendeur') && $sale->user_id != $user->id) {
            abort(403, 'Vous ne pouvez voir que vos propres ventes.');
        } elseif (!$user->hasRole('admin') && !$user->hasRole('vendeur') && !$user->hasRole('fournisseur')) {
            abort(403);
        }
        
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

        $this->recordActivity(
            'sale_validated',
            $sale,
            'Sale #' . $sale->id . ' validated. Total: ' . $sale->total_ttc . ' MAD. Items: ' . $itemsSummary
        );
    }
}