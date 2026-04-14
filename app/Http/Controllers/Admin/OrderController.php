<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 📦 LIST ORDERS
    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // 👁 SHOW ORDER
    public function show(Order $order)
    {
        $order->load('items.product', 'customer');

        return view('admin.orders.show', compact('order'));
    }

    // 🔄 UPDATE STATUS ONLY
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour');
    }
}