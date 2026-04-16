<?php
use App\Models\Order;

class OrderTrackingService
{
    private const MESSAGES = [
        'pending'    => ['title'=>'Order Received',     'description'=>'Waiting for payment confirmation.'],
        'confirmed'  => ['title'=>'Payment Confirmed',  'description'=>'Seller will process the order soon.'],
        'processing' => ['title'=>'Order Processing',   'description'=>'Product is being packed.'],
        'shipped'    => ['title'=>'Order Shipped',      'description'=>'Package is on its way to you.'],
        'delivered'  => ['title'=>'Order Delivered',    'description'=>'Congratulations! Package has arrived.'],
        'cancelled'  => ['title'=>'Order Cancelled',    'description'=>'This order has been cancelled.'],
    ];

    public function addEvent(Order $order, string $status, string $location=null): void {
        $msg = self::MESSAGES[$status] ?? ['title'=>ucfirst($status),'description'=>''];
        $order->tracking()->create(['status'=>$status,'title'=>$msg['title'],
            'description'=>$msg['description'],'location'=>$location,'occurred_at'=>now()]);
    }
}

?>