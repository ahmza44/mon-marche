<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Afficher tous les clients
   public function index()
{
    $customers = Customer::withCount('orders')->paginate(10);

    return view('customers.index', compact('customers'));
}
    // Formulaire Ajouter Client
    public function create() {
        return view('customers.form');
    }

    // Stocker Client
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);
      
        return redirect()->route('customers.index')->with('success', 'Client ajouté avec succès !');
    }

    // Formulaire Edit Client
    public function edit(Customer $customer) {
        return view('customers.form', compact('customer'));
    }

    // Mettre à jour Client
    public function update(Request $request, Customer $customer) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
        ]);

        $data = $request->only(['name','email','phone','address','city']);
        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Client mis à jour avec succès !');
    }

    // Supprimer Client
    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Client supprimé avec succès !');
    }
      public function home(Request $request)
{
    $query = Product::with('category');

    // 🔍 SEARCH
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->paginate(8); // ✅ مهم بزاف
    $categories = Category::all();

    return view('pages.accuiel', compact('products', 'categories'));
}

public function checkout()
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart vide');
    }

    $order = Order::create([
        'customer_id' => auth()->id(),
        'total' => 0,
        'status' => 'pending',
    ]);

    $total = 0;

    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product']->id,
            'price' => $item['product']->price,
            'quantity' => $item['quantity'],
        ]);

        $total += $item['product']->price * $item['quantity'];
    }

    $order->update(['total' => $total]);

    session()->forget('cart');

    return redirect()->route('orders.show', $order->id)
        ->with('success', 'Commande créée avec succès');
}

}