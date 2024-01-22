<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\productcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubcategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    dd(123);
});

//categories Route
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/all-categories', [CategoryController::class, 'allCategories'])->name('categories.all');
Route::get('/categories/{category}', [CategoryController::class, 'showProducts'])->name('categories.showProducts');
Route::get('/subcategories/create', [SubcategoryController::class,'create'])->name('subcategories.create');
Route::get('/subcategories/{subcategory}', [CategoryController::class, 'showSubcategoryProducts'])->name('subcategories.showProducts');

//subCategories Route
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
Route::get('/subcategories/{id}',[SubcategoryController::class,'view'])->name('subcategories.view');


Route::get('/product', [productcontroller::class, 'index'])->name('product.index');
Route::get('/product/create',[productcontroller::class,'create'])->name('product.create');
Route::post('/product',[productcontroller::class,'store'])->name('product.store');
// Route::get('subcategory/{subcategoryId}', [productcontroller::class, 'showProductsBySubcategory'])->name('product.view');
Route::get('/product/{id}',[productcontroller::class,'view'])->name('product.show');


