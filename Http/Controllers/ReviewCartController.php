<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\Cart; // Make sure to replace 'App\Models' with the actual namespace where your Cart model is defined
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewCartController extends Controller
{
    public function index()

    {if(Auth::check()){
        $cartItems = session('cart', []);

        $products = Product::whereIn('id', array_keys($cartItems))->get();
    
        return view('product.review-cart', compact('products', 'cartItems'));
    }
    else{
        return view('auth.login');
    }
    }        
         public function placeorder(Request $request){
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'zip' => 'required|string|max:10',
                'cardname' => 'required|string|max:255',
                'cardnumber' => 'required|numeric|digits_between:16,19',
                'expmonth' => 'required|numeric|size:2',
                'expyear' => 'required|numeric|size:4',
                'cvv' => 'required|numeric|digits:3',
            ]);
            $user = Auth::user();
            $order = Order::create([
                'user_id' => $user->id,
                'fullname' => $request->input('firstname'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
                'card_name' => $request->input('cardname'),
                'credit_card_number' => $request->input('cardnumber'),
                'exp_month' => $request->input('expmonth'),
                'exp_year' => $request->input('expyear'),
                'cvv' => $request->input('cvv'),
                  
            ]);
            // Get the cart items from the session
            $cart = $request->session()->get('cart', []);
            foreach ($cart as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'product_id' => $cartItem['id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                    
                ]);
            }
            $request->session()->forget('cart');
            return back()->withSuccess('Place Order SuccessFully');

        }
    }

