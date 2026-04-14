<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'shipping_address',
        'courier',
        'courier_service',
        'tracking_number',
        'subtotal',
        'discount_amount',
        'shipping_cost',
        'total',
        'payment_method',
        'payment_status',
        'midtrans_order_id',
        'stripe_payment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tracking()
    {
        return $this->hasOne(OrderTracking::class);
    }

    public function getStatusStepAttribute()
    {
        $statusSteps = [
            'pending'    => 0, 'confirmed'  => 1,
            'processing' => 2, 'shipped'    => 3,
            'delivered'  => 4, 'cancelled'  => 5,
        ];
        return $statusSteps[$this->status] ?? 0;
    }
}
