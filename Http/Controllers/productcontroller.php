<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class productcontroller extends Controller
{

    public function index(){
        $products = product::all();
        return view('product.index', compact('products'));
    }
    public function create(){
        return view('product.create');
    }
    public function store(Request $request){
        $imagename = time() . '.' .$request->image->extension();
        $request->image->move(public_path('products'),$imagename);
        $product = new product();
        $product->name = $request->name;
        $product->image = $imagename;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->save();
        return back()->withSuccess('product Added');

    }
    // public function showProductsBySubcategory($subcategoryId)
    // {
    //     //  dd($subcategoryId);
    //     // $subcategory = Subcategory::with('products')->find($subcategoryId);
    //     // $products = $subcategory->product;

    //     // return view('product.view', compact('products'));
    // }

}
