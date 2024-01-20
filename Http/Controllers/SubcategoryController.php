<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // if ($request->hasFile('image')) {
        //     $data['image'] = $request->file('image')->store('subcategory_images', 'public');
        // }

        // Subcategory::create($data);

        // return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
        $imagename = time(). '.' .$request->image->extension();
        $request->image->move(public_path('products'),$imagename);
        $category = new subcategory();
        $category->category_id = $request->category_id;
        $category->name = $request->name;
        $category->image = $imagename;
        // $category->slug = (str::slug($request->slug));
        $category->save();
        return back()->withSuccess('SubCategory Added.....');
    }
    public function view($id){
         
            $subcategory = DB::table('subcategories')->where('id',$id)->get();
             return view('subcategories/view',['subcategories'=>$subcategory]);
    }
    // public function showProducts($id)
    // {
    //     $subcategory = Subcategory::findOrFail($id);
    //     $products = $subcategory->products;

    //     return view('subcategories.view', compact('subcategory', 'products'));
    // }

   
}
