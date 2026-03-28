<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public $search = '';
    public $category_id = '';
    public $supplier_id = '';

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('barcode', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->supplier_id, function ($query) {
                $query->where('supplier_id', $this->supplier_id);
            })
            ->with(['category', 'supplier'])
            ->get();

        $categories = \App\Models\Category::all();
        $suppliers = \App\Models\Supplier::all();

        return view('livewire.product-search', [
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->category_id = '';
        $this->supplier_id = '';
    }
}