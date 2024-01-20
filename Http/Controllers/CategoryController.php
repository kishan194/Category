<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::all();
        // return view('categories.index', compact('categories'));
        $categories = Category::all();
        $categoryTree = $this->CategoryTree($categories);
        return view('categories/index', ['categories' => $categoryTree]);
    }
    public function CategoryTree($categories, $parentId = 0)
{
    $categoryTree = [];

    foreach ($categories as $category) {
        if ($category->category_id == $parentId) {
            $subcategory = $this->CategoryTree($categories, $category->id);
            if ($subcategory) {
                $category->setAttribute('children', $subcategory);
            }
            $categoryTree[] = $category;
        }
    }
    return $categoryTree;
}
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // if ($request->hasFile('image')) {
        //     $data['image'] = $request->file('image')->store('category_images', 'public');
        // }
        // Category::create($data);
        // return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        $imagename = time(). '.' .$request->image->extension();
        $request->image->move(public_path('products'),$imagename);
        $category = new category();
        $category->name = $request->name;
        $category->image = $imagename;
        //$category->slug = (str::slug($request->slug));
        $category->save();
        return back()->withSuccess('Category Added.....');
        
    }
    public function allCategories()
    {
        $categories = Category::with('subcategories')->get();

        return view('categories/allcategories', compact('categories'));
    }
    

   
}
