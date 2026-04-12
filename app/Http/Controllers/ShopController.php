<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 🏠 All products page
    public function products(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->paginate(8);

    return view('pages.produits', compact('products'));
}

    // 📂 Categories page
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('pages.categorie', compact('categories'));
    }

    // 📁 Products by category
    public function showCategory(Category $category)
    {
        $products = $category->products()->latest()->paginate(12);
        return view('pages.produits', compact('products', 'category'));
    }

    // 🛒 Cart page
    public function cart()
{
    $cart = session('cart', []);

    foreach ($cart as &$item) {
        $item['product'] = Product::find($item['product_id']);
    }

    return view('pages.cart', compact('cart'));
}

    // ➕ Add to cart
    public function addToCart(Product $product)
    {
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'quantity' => 1
            ];
        } else {
            $cart[$product->id]['quantity']++;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produit ajouté au panier !');
    }

    // ❌ Remove item
    public function removeFromCart(Product $product)
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produit supprimé !');
    }

    // 🧹 Clear cart
    public function clearCart()
    {
        session()->forget('cart');

        return back()->with('success', 'Panier vidé !');
    }

    // 💰 Calculate total
    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }

        return $total;
    }

    // 💳 Checkout
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Panier vide !');
        }

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // total
        $total = $this->calculateTotal($cart);

        // create order
        $order = Order::create([
            'customer_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // create items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('customer.cart')
            ->with('success', 'Commande créée avec succès !');
    }
}