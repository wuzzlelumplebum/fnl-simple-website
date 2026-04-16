<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, News, Review};

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->isLoyalCustomer()) {
            // Loyal Customers see upcoming + available — upcoming first
            $allProducts     = Product::with('category')->orderBy('status_id')->get();
            $showDiscount    = true;
            $productTabLabel = 'Upcoming Design';
        } else {
            // Guests and regular customers see available only
            $allProducts     = Product::with('category')->where('status_id', 2)->get();
            $showDiscount    = false;
            $productTabLabel = 'Latest Design';
        }

        // Filter from same collection — no extra DB queries
        $tshirts = $allProducts->where('category_id', 1)->values();
        $pants   = $allProducts->where('category_id', 2)->values();
        $caps    = $allProducts->where('category_id', 3)->values();

        $reviews = Review::with('user')->latest()->take(6)->get();
        $news    = News::latest()->take(6)->get();

        return view('home', compact(
            'allProducts','tshirts','pants','caps',
            'showDiscount','productTabLabel',
            'reviews','news'
        ));
    }
}
