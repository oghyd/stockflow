<?php

namespace App\Livewire\Caisse;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public array $cart = [];
    public string $search = '';

    public function addProduct(int $productId): void
    {
        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        $currentQty = $this->cart[$productId]['quantity'] ?? 0;

        if ($currentQty + 1 > $product->stock_quantity) {
            session()->flash('error', 'Stock insuffisant pour ce produit.');
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
            $this->cart[$productId]['subtotal'] =
                $this->cart[$productId]['quantity'] * $this->cart[$productId]['unit_price'];
        } else {
            $this->cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'unit_price' => (float) $product->sale_price,
                'quantity' => 1,
                'subtotal' => (float) $product->sale_price,
                'stock_quantity' => $product->stock_quantity,
            ];
        }
    }

    public function removeItem(int $productId): void
    {
        unset($this->cart[$productId]);
    }

    public function updateQuantity(int $productId, int $qty): void
    {
        if (!isset($this->cart[$productId])) {
            return;
        }

        if ($qty <= 0) {
            $this->removeItem($productId);
            return;
        }

        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        if ($qty > $product->stock_quantity) {
            session()->flash('error', 'La quantité demandée dépasse le stock disponible.');
            return;
        }

        $this->cart[$productId]['quantity'] = $qty;
        $this->cart[$productId]['subtotal'] = $qty * $this->cart[$productId]['unit_price'];
    }

    public function getCartItemsProperty(): array
    {
        return array_values($this->cart);
    }

    public function getItemsCountProperty(): int
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    public function getTotalTtcProperty(): float
    {
        return array_sum(array_column($this->cart, 'subtotal'));
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('barcode', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->limit(10)
            ->get();
    }

    public function validateSale(): void
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Le panier est vide.');
            return;
        }

        DB::transaction(function () {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'total_ttc' => $this->totalTtc,
                'validated_at' => now(),
            ]);

            foreach ($this->cart as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if (!$product) {
                    throw new \Exception('Produit introuvable.');
                }

                if ($item['quantity'] > $product->stock_quantity) {
                    throw new \Exception("Stock insuffisant pour {$product->name}.");
                }

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                ]);

                $product->decrement('stock_quantity', $item['quantity']);
            }
        });

        $this->cart = [];
        session()->flash('success', 'Vente validée avec succès.');
    }

    public function render()
    {
        return view('livewire.caisse.cart');
    }
}
