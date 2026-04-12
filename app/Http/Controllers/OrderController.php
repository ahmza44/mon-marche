<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // =====================
    // ADMIN: LIST ORDERS
    // =====================
    public function index()
{
    $orders = Order::with(['customer', 'items.product'])
        ->latest()
        ->paginate(10);

    return view('orders.index', compact('orders'));
}

    // =====================
    // SHOW SINGLE ORDER
    // =====================
    public function show(Order $order)
    {
        $order->load('items.product', 'customer');

        return view('orders.show', compact('order'));
    }

    // =====================
    // CREATE ORDER FROM CART
    // =====================
    public function store(Request $request)
{
    // 🔴 1. check auth
    if (!auth()->check()) {
        return redirect()->route('login')
            ->with('error', 'Vous devez être connecté');
    }

    $cart = session('cart', []);

    // 🔴 2. check cart empty
    if (empty($cart)) {
        return back()->with('error', 'Panier vide !');
    }

    DB::beginTransaction();

    try {

        // 🔵 create order
        $order = Order::create([
            'customer_id' => auth()->id(), // ✅ better than auth()->user()->id
            'total' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        foreach ($cart as $item) {

            $product = $item['product'];
            $qty = $item['quantity'];

            $subtotal = $product->price * $qty;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        $order->update([
            'total' => $total
        ]);

        session()->forget('cart');

        DB::commit();

        return redirect()->route('customer.cart')
            ->with('success', 'Commande validée avec succès !');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', 'Erreur lors de la commande');
    }
}
    // =====================
    // CHANGE STATUS (ADMIN)
    // =====================
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour');
    }
}