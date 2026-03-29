<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Traits\Loggable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'alert_threshold' => 'required|integer|min:0',
            'barcode' => 'nullable|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product = Product::create($data);

        Loggable::recordActivity(
            'product_created',
            $product,
            'Product "' . $product->name . '" was created with stock ' . $product->stock_quantity
        );

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit créé avec succès');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'alert_threshold' => 'required|integer|min:0',
            'barcode' => 'nullable|string|unique:products,barcode,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product->update($data);

        Loggable::recordActivity(
            'product_updated',
            $product,
            'Product "' . $product->name . '" was updated'
        );

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit modifié avec succès');
    }

    public function destroy(Product $product)
    {
        Loggable::recordActivity(
            'product_deleted',
            $product,
            'Product "' . $product->name . '" was deleted'
        );

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé avec succès');
    }
}