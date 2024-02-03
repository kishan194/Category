<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    
public function updateQuantity(Request $request)
{
    $productId = $request->input('id');
    $quantity = $request->input('quantity');

    $cartItems = session('cart', []);

    $found = false;

    foreach ($cartItems as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] = max(1, $quantity); // Ensure quantity doesn't go below 1
            $found = true;
            break;
        }
    }

    if (!$found) {
        // Product not in cart, add it
        $cartItems[] = [
            'id' => $productId,
            'quantity' => max(1, $quantity), // Ensure quantity doesn't go below 1
            // Add other product details here
        ];
    }

    session(['cart' => $cartItems]);
}
}

