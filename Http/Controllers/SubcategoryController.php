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
        $subcategories = Subcategory::paginate(5);
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
         
            $subcategory = DB::table('subcategories')->where('id',$id)->paginate(10);
             return view('subcategories/view',['subcategories'=>$subcategory]);
     
    }

   
}
