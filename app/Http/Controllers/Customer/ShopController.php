<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 🛒 CART PAGE
    public function cart()
    {
        $cart = session()->get('cart', []);

        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $item) {

            if (isset($products[$id])) {

                $subtotal = $products[$id]->price * $item['quantity'];

                $cartItems[] = [
                    'product' => $products[$id],
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }
        }

        return view('customer.pages.cart', compact('cartItems', 'total'));
    }

    // ➕ ADD TO CART
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produit ajouté au panier');
    }

    // ❌ REMOVE ITEM
    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Produit supprimé');
    }

    // 🧹 CLEAR CART
    public function clearCart()
    {
        session()->forget('cart');

        return back()->with('success', 'Panier vidé');
    }

    // 💳 CHECKOUT
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Panier vide');
        }

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $total = 0;

        foreach ($cart as $id => $item) {
            if (isset($products[$id])) {
                $total += $products[$id]->price * $item['quantity'];
            }
        }

        $order = Order::create([
            'customer_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            if (isset($products[$id])) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $products[$id]->price,
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('shop.cart')
            ->with('success', 'Commande créée avec succès');
    }
}