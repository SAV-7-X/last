<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;

// Livewire Authentication Routes
use App\Livewire\Auth\{Login, Register};
use App\Livewire\{Billing, Dashboard, Profile, Users,Product, Category, Order, 
    Customer, Review, Coupon, User, 
    Report, Setting};
    use App\Livewire\Frontend\{
        Index,
        Shop,
        About,
        Service,
        Blog,
        Contact,
        Cart,
        Support,
        Knowledge,
        LiveChat,
        Jobs,
        Team,
        Leadership,
        Privacy
    };

// Livewire Admin Routes
// use App\Livewire\{
    
// };

// =============================
// 🔹 AUTHENTICATION ROUTES
// =============================
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(Admin::class)->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/users', Users::class)->name('users');

    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        session()->flush();
        return redirect('/');
    })->name('logout');
});

// =============================
// 🔹 ADMIN DASHBOARD ROUTES
// =============================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/products', Product::class)->name('products');
    Route::get('/categories', Category::class)->name('categories');
    Route::get('/orders', Order::class)->name('orders');
    Route::get('/customers', Customer::class)->name('customers');
    Route::get('/reviews', Review::class)->name('reviews');
    Route::get('/coupons', Coupon::class)->name('coupons');
    Route::get('/users', Users::class)->name('users');  // Manage admins & customers
    Route::get('/reports', Report::class)->name('reports'); // Sales reports
    Route::get('/settings', Setting::class)->name('settings');
});


// Route::fallback(function () {
//     return redirect('/login');
// });

Route::prefix('/')->group(function () {
    Route::get('', Index::class)->name('home');
    // Route::get('shop', Shop::class)->name('shop');
    // Route::get('about', About::class)->name('about');
    // Route::get('services', Service::class)->name('services');
    // Route::get('blog', Blog::class)->name('blog');
    // Route::get('contact', Contact::class)->name('contact');
    
        Route::get('shop', function () {
        return redirect('/');
    })->name('shop');

    Route::get('about', function () {
        return redirect('/');
    })->name('about');

    Route::get('services', function () {
        return redirect('/');
    })->name('services');

    Route::get('blog', function () {
        return redirect('/');
    })->name('blog');

    Route::get('contact', function () {
        return redirect('/');
    })->name('contact');


    Route::get('cart', Cart::class)->name('cart');
    Route::get('/profile', Profile::class)->name('profile');


    // Footer Links
    Route::get('support', Support::class)->name('support');
    Route::get('knowledge', Knowledge::class)->name('knowledge');
    Route::get('livechat', LiveChat::class)->name('livechat');
    Route::get('jobs', Jobs::class)->name('jobs');
    Route::get('team', Team::class)->name('team');
    Route::get('leadership', Leadership::class)->name('leadership');
    Route::get('privacy-policy', Privacy::class)->name('privacy');
});