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
        $product->save();
        return back()->withSuccess('product Added');

    }
  
    public function view($id){

                
               $product = DB::table('products')->where('id',$id)->get();
                return view('product/view',['products'=>$product]);
    }

}
