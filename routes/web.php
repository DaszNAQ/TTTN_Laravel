<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ClientOrderLookupController;
use App\Http\Controllers\Admin\AdminController;

// Xem trạng thái đơn hàng
Route::get('/orders/lookup', [ClientOrderLookupController::class, 'form'])->name('client.orders.form');
Route::get('/orders/search', [ClientOrderLookupController::class, 'search'])->name('client.orders.search');


// Đăng nhập / đăng ký / quên mật khẩu
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginpost'])->name('loginpost');

Route::get('/forgotpass', [UserController::class, 'forgotpass'])->name('forgotpass');
Route::post('/forgotpass', [UserController::class, 'forgotpasspost'])->name('forgotpasspost');

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.update');
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// ===============================
// Route cho Giao diện User (Client)
// ===============================
// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Đặt hàng
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// Xem giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Xoá sản phẩm khỏi giỏ hàng
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Đặt hàng
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');


// Xem danh mục
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.products');
// Xem chi tiết sản phẩm
Route::get('/product/{id}', [HomeController::class, 'detail'])->name('product.detail');

// Tìm kiếm sản phẩm
Route::get('/search', [HomeController::class, 'search'])->name('product.search');


// Khuyến mãi, tin tức, thông tin liên hệ
Route::get('/tin-tuc', [PageController::class, 'news'])->name('news');
Route::get('/khuyen-mai', [PageController::class, 'promotion'])->name('promotion');
Route::get('/lien-he', [PageController::class, 'contact'])->name('contact');


// ===============================
// Route cho Giao diện Admin
// ===============================
Route::prefix('ad')->name('admin.')->middleware('auth')->group(function () {
    Route::redirect('/', '/ad/dashboard');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


    // CRUD Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('categories-trash', [App\Http\Controllers\Admin\CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('categories-restore/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories-force-delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // CRUD Brands
    Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
    Route::get('brands-trash', [App\Http\Controllers\Admin\BrandController::class, 'trash'])->name('brands.trash');
    Route::post('brands-restore/{id}', [App\Http\Controllers\Admin\BrandController::class, 'restore'])->name('brands.restore');
    Route::delete('brands-force-delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'forceDelete'])->name('brands.forceDelete');

    // CRUD Products
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::get('products-trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('products.trash');
    Route::post('products-restore/{id}', [App\Http\Controllers\Admin\ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products-force-delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'forceDelete'])->name('products.forceDelete');

    // CRUD Users (Chỉ Admin mới được vào)
    Route::middleware(['auth','checkrole:admin'])->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::get('users-trash', [App\Http\Controllers\Admin\UserController::class, 'trash'])->name('users.trash');
        Route::post('users-restore/{id}', [App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');
        Route::delete('users-force-delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'forceDelete'])->name('users.forceDelete');
    });

    // CRUD Customers
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
    Route::get('customers-trash', [App\Http\Controllers\Admin\CustomerController::class, 'trash'])->name('customers.trash');
    Route::post('customers-restore/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'restore'])->name('customers.restore');
    Route::delete('customers-force-delete/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'forceDelete'])->name('customers.forceDelete');

    // CRUD Orders
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::get('orders-trash', [App\Http\Controllers\Admin\OrderController::class, 'trash'])->name('orders.trash');
    Route::post('orders-restore/{id}', [App\Http\Controllers\Admin\OrderController::class, 'restore'])->name('orders.restore');
    Route::delete('orders-force-delete/{id}', [App\Http\Controllers\Admin\OrderController::class, 'forceDelete'])->name('orders.forceDelete');

    // CRUD Order Items
    Route::resource('order-items', App\Http\Controllers\Admin\OrderItemController::class);
    Route::get('order-items-trash', [App\Http\Controllers\Admin\OrderItemController::class, 'trash'])->name('order_items.trash');
    Route::post('order-items-restore/{id}', [App\Http\Controllers\Admin\OrderItemController::class, 'restore'])->name('order_items.restore');
    Route::delete('order-items-force-delete/{id}', [App\Http\Controllers\Admin\OrderItemController::class, 'forceDelete'])->name('order_items.forceDelete');
});
