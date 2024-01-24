<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Category;
Use App\Models\Subcategory;

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

        
        $imagename = time(). '.' .$request->image->extension();
        $request->image->move(public_path('products'),$imagename);
        $category = new category();
        $category->name = $request->name;
        $category->image = $imagename;
        $category->save();
        return back()->withSuccess('Category Added.....');
        
    }
    public function allCategories()
    {
        $categories = Category::with('subcategories')->get();
        return view('categories/allcategories', compact('categories'));
    }

    

public function showProducts(Category $category)
{
    $category = Category::with('subcategories.products')->find($category->id);
    return view('categories.showProducts', compact('category'));
}

    public function showSubcategoryProducts(Subcategory $subcategory)
    {
        $products = $subcategory->products;
        $subcategories = $subcategory->subcategories;
        return view('subcategories.showProducts', compact('subcategory', 'products', 'subcategories',));
    }
    }
