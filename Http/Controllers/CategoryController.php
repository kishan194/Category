<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
Use App\Models\Category;
Use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoryTree = $this->CategoryTree($categories);
    
        // Convert the array to a collection to enable pagination
        $categoryCollection = collect($categoryTree);
    
        // Paginate the collection
        $perPage = 5; // Number of categories per page
        $currentPage = request()->query('page', 1); // Get the current page from the request query parameters
        $pagedData = $categoryCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $categories = new LengthAwarePaginator($pagedData, count($categoryCollection), $perPage, $currentPage, [
            'path' => request()->url(), // URL path for pagination links
            'query' => request()->query(), // Additional query parameters for pagination links
        ]);
    
        return view('categories.index', compact('categories'));
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
