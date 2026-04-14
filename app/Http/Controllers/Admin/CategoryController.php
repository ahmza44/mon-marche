<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // ADMIN INDEX
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // CREATE
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE
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

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès !');
    }

    // EDIT
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        $data = [
            'name' => $request->name,
        ];

        // replace image if new one uploaded
        if ($request->hasFile('image')) {

            // delete old image (important)
            if ($category->image && $category->image !== 'categories/default.png') {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès !');
    }

    // DELETE
    public function destroy(Category $category)
    {
        // delete image
        if ($category->image && $category->image !== 'categories/default.png') {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }
}