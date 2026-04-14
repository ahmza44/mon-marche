<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoriesController extends Controller
{
    // 📌 Show all categories (customer page)
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('customer.pages.categorie', compact('categories'));
    }

    // 📌 Show products inside category
    public function show(Category $category)
    {
        $products = $category->products;

        return view('customer.pages.category-products', compact('category', 'products'));
    }
}