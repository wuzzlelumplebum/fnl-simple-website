<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Midtrans\Config as MidConfig;
use Midtrans\Snap;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Cart;
use App\Models\{Order, ProductVariant};

class CheckoutController extends Controller
{
    public function index() {
        if (Cart::isEmpty()) return redirect()->route('cart.index')->with('error','Keranjang kosong.');
        return view('checkout.index',[
            'addresses'  => auth()->user()->addresses ?? [],
            'cartItems'  => Cart::getContent(),
            'cartTotal'  => (int)Cart::getTotal(),
        ]);
    }

    // ── Create Midtrans Snap Token ──────────────────────────────
    public function createMidtransToken(Request $request) {
        MidConfig::$serverKey    = config('services.midtrans.server_key');
        MidConfig::$isProduction = config('services.midtrans.is_production');
        MidConfig::$isSanitized  = true;
        MidConfig::$is3ds        = true;

        $total   = (int)Cart::getTotal();
        $orderId = 'FNL-'.strtoupper(uniqid());

        $order = Order::create(['user_id'=>auth()->id(),'order_number'=>$orderId,
            'midtrans_order_id'=>$orderId,'status'=>'pending','total'=>$total,
            'shipping_address'=>$request->shipping_address ?? '',
            'payment_method'=>'midtrans','payment_status'=>'unpaid']);

        $this->saveOrderItems($order);

        $itemDetails = Cart::getContent()->map(fn($i)=>
            ['id'=>(string)$i->id,'price'=>(int)$i->price,'quantity'=>$i->quantity,'name'=>substr($i->name,0,50)]
        )->values()->toArray();

        $snapToken = Snap::getSnapToken([
            'transaction_details'=>['order_id'=>$orderId,'gross_amount'=>$total],
            'customer_details'=>['first_name'=>auth()->user()->first_name,'email'=>auth()->user()->email],
            'item_details'=>$itemDetails,
            'enabled_payments'=>['gopay','shopeepay','qris','bank_transfer','indomaret','alfamart','credit_card'],
        ]);

        session(['pending_order_id'=>$order->id]);
        return response()->json(['snap_token'=>$snapToken]);
    }

    // ── Midtrans Webhook ─────────────────────────────────────────
    public function midtransWebhook() {
        MidConfig::$serverKey = config('services.midtrans.server_key');
        $notif  = new \Midtrans\Notification();
        $order  = Order::where('midtrans_order_id',$notif->order_id)->first();
        if (!$order) return response()->json(['status'=>'not found'],404);
        if (in_array($notif->transaction_status,['capture','settlement'])) {
            $order->update(['payment_status'=>'paid','status'=>'confirmed']);
            $this->deductStock($order);
            Cart::clear();
        }
        return response()->json(['status'=>'ok']);
    }

    // ── Create Stripe PaymentIntent ──────────────────────────────
    public function createStripeIntent(Request $request) {
        Stripe::setApiKey(config('services.stripe.secret'));
        $total   = (int)Cart::getTotal();
        $orderId = 'FNL-STRIPE-'.strtoupper(uniqid());
        $order   = Order::create(['user_id'=>auth()->id(),'order_number'=>$orderId,'status'=>'pending',
            'total'=>$total,'shipping_address'=>$request->shipping_address ?? '',
            'payment_method'=>'stripe','payment_status'=>'unpaid']);
        $this->saveOrderItems($order);
        $intent = PaymentIntent::create(['amount'=>$total,'currency'=>'idr',
            'metadata'=>['order_id'=>$orderId]]);
        session(['pending_order_id'=>$order->id]);
        return response()->json(['client_secret'=>$intent->client_secret,'publishable_key'=>config('services.stripe.key')]);
    }

    // ── Stripe Webhook ───────────────────────────────────────────
    public function stripeWebhook(Request $request) {
        $event = \Stripe\Webhook::constructEvent($request->getContent(),$request->header('Stripe-Signature'),config('services.stripe.webhook_secret'));
        if ($event->type === 'payment_intent.succeeded') {
            $intent = $event->data->object;
            $order  = Order::where('order_number',$intent->metadata->order_id)->first();
            if ($order) { $order->update(['payment_status'=>'paid','stripe_payment_id'=>$intent->id,'status'=>'confirmed']); $this->deductStock($order); Cart::clear(); }
        }
        return response()->json(['received'=>true]);
    }

    public function success() {
        $order = Order::find(session('pending_order_id'));
        session()->forget(['pending_order_id']);
        return view('checkout.success', compact('order'));
    }

    // ── Private helpers ──────────────────────────────────────────
    private function saveOrderItems(Order $order): void {
        foreach (Cart::getContent() as $item) {
            $order->items()->create(['product_id'=>$item->id,'variant_id'=>$item->attributes->variant_id ?? null,
                'product_name'=>$item->name,'variant_info'=>$item->attributes->variant_label ?? null,
                'quantity'=>$item->quantity,'unit_price'=>(int)$item->price,
                'total_price'=>(int)($item->price*$item->quantity)]);
        }
    }
    private function deductStock(Order $order): void {
        foreach ($order->items as $item) {
            if (!$item->variant_id) continue;
            $variant = \App\Models\ProductVariant::find($item->variant_id);
            if ($variant) $variant->decrement('stock',$item->quantity);
        }
    }
}
