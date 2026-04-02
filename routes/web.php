<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Импорты для админ-панели
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/* Публичные маршруты */
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submit'])->name('contact.post');

// Каталог и товары
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Услуги
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::post('/rent', [ServiceController::class, 'rent'])->name('rent.submit')->middleware('auth');
Route::post('/repair-request', [ServiceController::class, 'repairRequest'])->name('repair.request');
Route::post('/lesson-booking', [ServiceController::class, 'lessonBooking'])->name('lesson.booking');

/* Авторизация */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/* Личный кабинет (только авторизованные) */
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/favorites/{product}', [ProfileController::class, 'addToFavorites'])->name('addFavorite');
    Route::delete('/favorites/{product}', [ProfileController::class, 'removeFromFavorites'])->name('removeFavorite');
});

/* Корзина */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

/* Оформление заказа (только авторизованные) */
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
});

/* Админ-панель (только администраторы) */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Главная
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Управление товарами
    Route::resource('products', AdminProductController::class);

    // Управление заказами
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Управление арендой
    Route::resource('rentals', AdminRentalController::class)->only(['index']);
    Route::put('rentals/{rental}/status', [AdminRentalController::class, 'updateStatus'])->name('rentals.updateStatus');

    // Сообщения из контактов
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Управление пользователями
    Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);
    Route::patch('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});
