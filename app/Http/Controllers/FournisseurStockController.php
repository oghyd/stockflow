<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FournisseurStockController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Récupérer les produits du fournisseur connecté
        $products = Product::whereHas('supplier', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['category', 'supplier'])->get();

        return view('fournisseur.stock', compact('products'));
    }
}