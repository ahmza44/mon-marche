<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;

class DashbordController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $customersCount = Customer::count();
        $ordersCount = Order::count();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $latestOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'productsCount',
            'categoriesCount',
            'customersCount',
            'ordersCount',
            'latestProducts',
            'latestOrders'
        ));
    }
}