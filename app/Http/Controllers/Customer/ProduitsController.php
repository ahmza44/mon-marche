<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    // =======================
    // INDEX (CACHE + PAGINATION)
    // =======================
  public function index(Request $request)
{
    $query = Product::with('category');

    // =====================
    // FILTER BY PRICE
    // =====================
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->latest()->paginate(8);

    return view('customer.pages.produits', compact('products'));
}


}