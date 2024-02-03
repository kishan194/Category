<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;

class ReviewCartController extends Controller
{
    public function index()
    {
         $cartItems = session('cart', []);

        $products = Product::whereIn('id', array_keys($cartItems))->get();
    
        return view('product.review-cart', compact('products', 'cartItems'));
    }
}
