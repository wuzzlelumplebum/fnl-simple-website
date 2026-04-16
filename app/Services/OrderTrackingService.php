<?php
use App\Models\Order;

class OrderTrackingService
{
    private const MESSAGES = [
        'pending'    => ['title'=>'Pesanan Masuk',           'description'=>'Menunggu konfirmasi pembayaran.'],
        'confirmed'  => ['title'=>'Pembayaran Dikonfirmasi',  'description'=>'Penjual akan segera memproses.'],
        'processing' => ['title'=>'Pesanan Diproses',         'description'=>'Produk sedang dikemas.'],
        'shipped'    => ['title'=>'Pesanan Dikirim',          'description'=>'Paket dalam perjalanan ke kamu.'],
        'delivered'  => ['title'=>'Pesanan Diterima',         'description'=>'Selamat! Paket sudah sampai.'],
        'cancelled'  => ['title'=>'Pesanan Dibatalkan',       'description'=>'Pesanan ini dibatalkan.'],
    ];

    public function addEvent(Order $order, string $status, string $location=null): void {
        $msg = self::MESSAGES[$status] ?? ['title'=>ucfirst($status),'description'=>''];
        $order->tracking()->create(['status'=>$status,'title'=>$msg['title'],
            'description'=>$msg['description'],'location'=>$location,'occurred_at'=>now()]);
    }
}

?>