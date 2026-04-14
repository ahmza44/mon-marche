<?php
//customer
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Customer\AccueilController;
use App\Http\Controllers\Customer\CategoriesController;
use App\Http\Controllers\Customer\ProduitsController;
use App\Http\Controllers\Customer\ShopController;
//admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
//login
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
/*
|--------------------------------------------------------------------------
| PUBLIC / HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [AccueilController::class, 'index'])->name('customer.accueil');
/*
|--------------------------------------------------------------------------
| AUTH (GOOGLE)
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
/*
|--------------------------------------------------------------------------
| CUSTOMER AREA (SHOP)
|--------------------------------------------------------------------------
*/
Route::prefix('shop')->group(function () {
    // PRODUCTS
    Route::get('/products', [ProduitsController::class, 'index'])->name('customer.products');
    // CATEGORIES
    Route::get('/categories', [CategoriesController::class, 'index'])->name('customer.categories');
    Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('customer.categories.show');
    // CART
    Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('shop.cart.add');
    Route::delete('/cart/remove/{product}', [ShopController::class, 'removeFromCart'])->name('shop.cart.remove');
    Route::post('/cart/clear', [ShopController::class, 'clearCart'])->name('shop.cart.clear');
    // CHECKOUT
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
});
/*
|--------------------------------------------------------------------------
| PROFILE (CLEAN - NO DUPLICATION)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.') // 🔥 IMPORTANT
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
    // PROFILE (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::get('/profile', function(){
    return view('profile.delete');
   })->name('profile.destroy');
   // PROFILE PAGE
Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::get('/profile/password', function () {
        return view('profile.password');
    })->name('profile.password');
    Route::get('/profile/supprimer', function () {
        return view('profile.delete');
    })->name('profile.supprimer');

});
   
//Route::get('/verify-email/{hash}',[ProfileController::class,'verifyEmail']);


   Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify');
/*Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
/* 

|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';