<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'alert_threshold',
        'barcode',
        'category_id',
        'supplier_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }




// Scopes
public function scopeLowStock($query)
{
    return $query->whereColumn('stock_quantity', '<=', 'alert_threshold');
}

public function scopeOutOfStock($query)
{
    return $query->where('stock_quantity', 0);
}



}