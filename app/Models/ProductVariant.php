<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'color_hex',
        'stock',
        'price_adjustment',
        'sku'
    ];

    protected $casts = [
        'stock' => 'integer',
        'price_adjustment' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Final price = base product price + adjustment
    public function getFinalPriceAttribute(): int
    {
        return $this->product->price + $this->price_adjustment;
    }

    // "M / Black" — stored in order_items even after variant is deleted
    public function getLabelAttribute(): string
    {
        return $this->size . ' / ' . $this->color;
    }
}
