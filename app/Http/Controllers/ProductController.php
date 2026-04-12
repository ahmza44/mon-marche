<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // =======================
    // INDEX (ONLY PAGINATION HERE)
    // =======================
    public function index(Request $request)
{
    $page = $request->page ?? 1;
    $search = $request->search ?? 'all';

    $cacheKey = "products_index_{$search}_page_{$page}";

    $products = Cache::remember($cacheKey, 60, function () use ($request) {

        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query->paginate(8); // ✅ هنا صافي
    });

    return view('pages.produits', compact('products'));
}
    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $categories = Category::all();
        return view('products.formProduct', compact('categories'));
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name', 'description', 'price', 'stock', 'category_id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        Cache::flush();

        return redirect()->route('products.index')
            ->with('success', 'Produit ajouté !');
    }

    // =======================
    // EDIT
    // =======================
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.formEdit', compact('product', 'categories'));
    }

    // =======================
    // UPDATE
    // =======================
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name', 'description', 'price', 'stock', 'category_id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        Cache::flush();

        return redirect()->route('products.index')
            ->with('success', 'Produit modifié !');
    }

    // =======================
    // DELETE
    // =======================
    public function destroy(Product $product)
    {
        $product->delete();

        Cache::flush();

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé !');
    }

    // =======================
    // EXPENSIVE (NO PAGINATION)
    // =======================
    public function expensiveProducts()
    {
        $products = Product::with('category')
            ->where('price', '>', 100)
            ->get();

        return view('pages.produits', compact('products'));
    }

    // =======================
    // FILTER BY CATEGORY
    // =======================
    public function filterByCategory($id)
    {
        $products = Product::with('category')
            ->where('category_id', $id)
            ->get();

        return view('pages.produits', compact('products'));
    }

    // =======================
    // SORT PRICE DESC
    // =======================
    public function sortByPriceDesc()
    {
        $products = Product::with('category')
            ->orderBy('price', 'desc')
            ->get();

        return view('pages.produits', compact('products'));
    }

    // =======================
    // TOP 5
    // =======================
    public function limitFive()
    {
        $products = Product::with('category')
            ->orderBy('price', 'desc')
            ->limit(5)
            ->get();

        return view('pages.produits', compact('products'));
    }
}