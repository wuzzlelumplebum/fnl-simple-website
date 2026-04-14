<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'name',
        'description',
        'category_id',
        'price',
        'quantity',
        'status_id',
        'image_path'
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // 10% discount for Loyal Customers
    public function getDiscountedPriceAttribute()
    {
        return (int) round($this->price * 0.90);
    }

    // Total stock across all variants
    public function getTotalStockAttribute(): int
    {
        return $this->variants->sum('stock');
    }

    // Average star rating
    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews->avg('rating') ?? 0, 1);
    }

}
