<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Traits\Loggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category_id');
        $supplierId = $request->get('supplier_id');

        $products = Product::with(['category', 'supplier'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($supplierId, function ($query, $supplierId) {
                $query->where('supplier_id', $supplierId);
            })
            ->get();

        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.index', compact(
            'products',
            'categories',
            'suppliers',
            'search',
            'categoryId',
            'supplierId'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $supplier = Supplier::where('user_id', Auth::id())->first();

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'barcode' => 'nullable|string|unique:products,barcode',
            'category_id' => 'required|exists:categories,id',
        ];

        if (!$supplier) {
            $rules['alert_threshold'] = 'required|integer|min:0';
            $rules['supplier_id'] = 'required|exists:suppliers,id';
        }

        $data = $request->validate($rules);

        if ($supplier) {
            $data['supplier_id'] = $supplier->id;
            $data['alert_threshold'] = $data['alert_threshold'] ?? 5;
        }

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
        $supplier = Supplier::where('user_id', Auth::id())->first();

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'barcode' => ['nullable', 'string', Rule::unique('products', 'barcode')->ignore($product->id)],
            'category_id' => 'required|exists:categories,id',
        ];

        if (!$supplier) {
            $rules['alert_threshold'] = 'required|integer|min:0';
            $rules['supplier_id'] = 'required|exists:suppliers,id';
        }

        $data = $request->validate($rules);

        if ($supplier) {
            $data['supplier_id'] = $supplier->id;
            $data['alert_threshold'] = $data['alert_threshold'] ?? $product->alert_threshold ?? 5;
        }

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