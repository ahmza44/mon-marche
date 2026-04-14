<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Mail\marcheMail;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccueilController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 📂 CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query
            ->latest()   // 🔥 مهم باش الجديد يبان فالفوق
            ->paginate(8);

        $categories = Category::withCount('products')->get();
         
        // Mail::to('sellamihamza56@gmail.com')->send(new marcheMail('hamza','sellamihamza56@gmail.com'));
        return view('customer.pages.accueil', compact('products', 'categories'));
    }
}