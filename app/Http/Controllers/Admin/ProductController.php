<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    // =======================
    // INDEX (CACHE + PAGINATION FIXED)
    // =======================
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 8;

        $cacheKey = "admin_products_page_{$page}";

        $products = Cache::remember($cacheKey, 60, function () use ($perPage) {
            return Product::with('category')
                ->latest()
                ->paginate($perPage);
        });

        return view('admin.products.index', compact('products'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name',
            'description',
            'price',
            'stock',
            'category_id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = 'products/default.png';
        }

        Product::create($data);

        // CLEAR CACHE (ALL PAGES)
        $this->clearCache();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit ajouté avec succès !');
    }

    // =======================
    // EDIT
    // =======================
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // =======================
    // UPDATE
    // =======================
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name',
            'description',
            'price',
            'stock',
            'category_id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // CLEAR CACHE
        $this->clearCache();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour !');
    }

    // =======================
    // DELETE
    // =======================
    public function destroy(Product $product)
    {
        $product->delete();

        // CLEAR CACHE
        $this->clearCache();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé !');
    }

    // =======================
    // OPTIONAL FILTERS
    // =======================
    public function expensiveProducts()
    {
        $products = Product::with('category')
            ->where('price', '>', 100)
            ->orderBy('price', 'desc')
            ->paginate(8);

        return view('admin.products.index', compact('products'));
    }

    public function sortByPriceDesc()
    {
        $products = Product::with('category')
            ->orderBy('price', 'desc')
            ->paginate(8);

        return view('admin.products.index', compact('products'));
    }

    public function limitFive()
    {
        $products = Product::with('category')
            ->orderBy('price', 'desc')
            ->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    // =======================
    // CACHE CLEAR METHOD
    // =======================
    private function clearCache()
    {
        // safe simple solution
        Cache::flush();
    }
}