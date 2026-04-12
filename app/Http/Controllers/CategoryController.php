<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
  class CategoryController extends Controller
{
    // ADMIN
    public function index() {
        $categories = Category::paginate(10);
        return view('pages.categorie', compact('categories'));
    }

    public function create() {
        return view('categories.form');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image',
    ]);

    $data = [
        'name' => $request->name,
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('categories', 'public');
    } else {
        $data['image'] = 'categories/default.png';
    }

    Category::create($data);

    return redirect()->route('categories.index')
        ->with('success', 'Catégorie ajoutée avec succès !');
}

    public function edit(Category $category) {
        return view('categories.form', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function destroy(Category $category) {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }

    // CUSTOMER
    public function indexCustomer()
    {
        $categories = Category::withCount('products')->get();
        return view('customer.categories.index', compact('categories'));
    }

    public function showCustomer(Category $category)
    {
        $products = $category->products;

        return view('customer.categories.show', compact('category', 'products'));
    }

}