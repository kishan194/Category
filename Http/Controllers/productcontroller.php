<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productcontroller extends Controller
{

    public function index(){
        $products = product::all();
        return view('product.index', compact('products'));
    }
    public function create(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('product.create',  compact('categories','subcategories'));
    }
    public function store(Request $request){
        $fileNames = [];

        foreach($request->file('image') as $image){
            $imageName = $image->getClientOriginalName();
            // $image->move(public_path().'/products/',$imageName);
            $image->move(public_path('products'),$imageName);
            $fileNames[] = $imageName;
        }
        
        $product = new product();
        $product->name = $request->name;        
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->image = json_encode($fileNames);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return back()->withSuccess('product Added');

    }
  
    public function view($id){   
               $product = DB::table('products')->where('id',$id)->get();
                return view('product/view',['products'=>$product]);
    }
    public function delete($id){
            $product = product::find($id);
             if(!is_null($product)){
              $product->delete();
             }
             return redirect()->back();
    }


    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = $request->session()->get('cart', []);
    
        $existingIndex = null;
    
        // Check if the product is already in the cart
        foreach ($cart as $index => $cartItem) {
            if ($cartItem['id'] == $product->id) {
                $existingIndex = $index;
                break;
            }
        }
        if ($existingIndex !== null) {
            //increment its quantity
            $cart[$existingIndex]['quantity']++;
        } else {
            // If the product is not in the cart
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product->category_id,
                'subcategory_id' => $product->subcategory_id,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 0,
            ];
        }
    
        // store the cart in the session
        $request->session()->put('cart', $cart);
    
        return back()->withSuccess('Add To Cart Successfully Done...');
    }
    

            
    public function removeFromCart(Request $request, $id){
        $cart = $request->session()->get('cart', []);
        // Find the index of array
        $index = array_search($id, array_column($cart, 'id'));
        // Remove the product
        if ($index !== false) {
            unset($cart[$index]);
            // Reset array
            $cart = array_values($cart);
            // Update the cart in the session
            $request->session()->put('cart', $cart);
            return back()->withSuccess('Remove From Cart Successfully Done...');
        }
        return redirect()->back()->with('error', 'Not Allowed');
    }

    public function checkout(){
        return view('product.checkout');
    }
    public function changeQty(Request $request,$id)
    {
       
        $cart = session()->get('cart');
        if ($request->change_to === 'down') {
            if (isset($cart[$request->id])) {
                if ($cart[$request->id]['quantity'] > 1) {
                    $cart[$request->id]['quantity']--;
                    return $this->setSessionAndReturnResponse($cart);
                } else {
                    return back();
                }
            }
        } else {
            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity']++;
                return $this->setSessionAndReturnResponse($cart);
            }
        }

        return back();
    }
    protected function setSessionAndReturnResponse($cart)
    {
        session()->put('cart', $cart);
        return back();
       
    }
}
