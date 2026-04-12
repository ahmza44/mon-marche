<?php

use App\Http\Controllers\Auth\GoogleController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomerController::class, 'home'])
    ->name('customer.accueil');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
/*
|--------------------------------------------------------------------------
| AUTH USER AREA (CUSTOMER)
|--------------------------------------------------------------------------
*/


    // SHOP
    Route::get('/produits', [ShopController::class, 'products'])->name('customer.products');
    Route::get('/categories', [ShopController::class, 'categories'])->name('customer.categories');
    Route::get('/categories/{category}', [ShopController::class, 'showCategory'])->name('customer.categories.show');

    // CART
    Route::get('/cart', [ShopController::class, 'cart'])->name('customer.cart');
    Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('customer.cart.add');
    Route::delete('/cart/remove/{product}', [ShopController::class, 'removeFromCart'])->name('customer.cart.remove');
    Route::post('/cart/clear', [ShopController::class, 'clearCart'])->name('customer.cart.clear');

    // CHECKOUT
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('customer.checkout');

    // PROFILE (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   // PROFILE PAGE
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    // PASSWORD PAGE
    Route::get('/profile/password', function () {
        return view('profile.password');
    })->name('profile.password');

    // DELETE PAGE
    Route::get('/profile/delete', function () {
        return view('profile.delete');
    })->name('profile.delete');
    Route::get('/products/expensive', [ProductController::class, 'expensiveProducts'])->name('products.expensive');
    Route::get('/products/sort/price-desc', [ProductController::class, 'sortByPriceDesc'])
    ->name('products.sort.price.desc');
    Route::get('/products/top5', [ProductController::class, 'limitFive'])
    ->name('products.top5');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth','admin'])
    ->group(function () {

        Route::get('/', [DashbordController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('orders', OrderController::class);
       
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');
    });

     
/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';