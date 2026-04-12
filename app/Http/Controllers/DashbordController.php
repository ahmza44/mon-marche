<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'productsCount' => Product::count(),
            'categoriesCount' => Category::count(),
            'customersCount' => Customer::count(),
            'ordersCount' => Order::count(),

            'latestProducts' => Product::with('category')
                ->latest()
                ->take(5)
                ->get(),

            'latestOrders' => Order::with('customer')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}