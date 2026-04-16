<?php

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class StockService
{
    const LOW_STOCK_THRESHOLD = 5;

    public function deductFromOrder(Order $order): void {
        foreach ($order->items as $item) {
            if (!$item->variant_id) continue;
            $variant = ProductVariant::find($item->variant_id);
            if (!$variant) continue;
            $newStock = max(0, $variant->stock - $item->quantity);
            $variant->update(['stock' => $newStock]);
            if ($newStock <= self::LOW_STOCK_THRESHOLD) {
                DB::table('stock_alerts')->updateOrInsert(
                    ['variant_id' => $variant->id],
                    ['product_name'=>$variant->product->name,'variant_label'=>$variant->label,
                     'current_stock'=>$newStock,'is_resolved'=>false,
                     'updated_at'=>now(),'created_at'=>now()]
                );
            }
        }
    }
}

?>