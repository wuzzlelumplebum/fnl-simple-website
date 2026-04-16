<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, ProductVariant};
use Cart;

class CartController extends Controller
{
    public function index() {
        return view('cart.index',['cartItems'=>Cart::getContent(),'cartTotal'=>(int)Cart::getTotal()]);
    }

    public function add(Request $request) {
        $request->validate(['product_id'=>'required|exists:products,id','variant_id'=>'required|exists:product_variants,id','quantity'=>'integer|min:1']);
        $product = Product::findOrFail($request->product_id);
        $variant = ProductVariant::findOrFail($request->variant_id);
        $qty     = $request->quantity ?? 1;

        if ($variant->stock < $qty)
            return back()->with('error',"Not enough stock. Available: {$variant->stock} pcs.");

        // Apply 10% discount for Loyal Customers
        $price = auth()->user()?->isLoyalCustomer()
            ? (int)($variant->final_price * 0.9)
            : $variant->final_price;

        Cart::add(['id'=>$variant->id,'name'=>$product->name,'price'=>$price,'quantity'=>$qty,
            'attributes'=>['product_id'=>$product->id,'variant_id'=>$variant->id,
                           'variant_label'=>$variant->label,'image_path'=>$product->image_path]]);

        return back()->with('success',$product->name.' ('.$variant->label.') added to cart!');
    }

    public function update(Request $request, string $rowId) {
        $request->validate(['quantity'=>'required|integer|min:1']);
        Cart::update($rowId,['quantity'=>$request->quantity]);
        return back()->with('success','Cart updated.');
    }

    public function remove(string $rowId) {
        Cart::remove($rowId);
        return back()->with('success','Item removed from cart.');
    }
}
