<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PopularController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Order\ShippingController;
use App\Http\Controllers\Data\DataReviewController;
use App\Http\Controllers\Data\DataWorkerController;
use App\Http\Controllers\SettingCustomerController;
use App\Http\Controllers\Data\DataProductController;
use App\Http\Controllers\Data\DataCategoryController;
use App\Http\Controllers\Data\DataDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes main
Route::get('/', function() {
    return redirect('/home');
});

// Dashboard admin manage Routes
Route::get('/admin/manage_dashboard', [DataDashboardController::class, 'index'])->middleware('admin');
Route::name('admin.')->prefix('manage_dashboard')->middleware(['admin'])->group(function() {
    Route::resource('products', DataProductController::class);
    Route::resource('categories', DataCategoryController::class);
    Route::resource('workers', DataWorkerController::class);
    Route::get('/reviews/list', [DataReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/detail/{products:uuid}', [DataReviewController::class, 'detail'])->name('reviews.detail');
    Route::delete('/reviews/remove/{reviews:id}', [DataReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/data/profile/{users:name}', [DataDashboardController::class, 'profile'])->name('profile.edit');
    Route::put('/data/profile/update/{users:id}', [DataDashboardController::class, 'update'])->name('profile.update');
    Route::put('/data/profile/password/update/{users:id}', [DataDashboardController::class, 'change'])->name('password.change');
});

// Authenticate Routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/send', [RegisterController::class, 'store'])->name('register.store');

// Customer Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product/detail/{products:uuid}', [HomeController::class, 'detailProduct'])->name('product.detail')->middleware('auth');
Route::post('/product/detail/review', [HomeController::class, 'addReviews'])->name('add.review')->middleware('auth');
Route::get('/about', function() {
    return view('pages.customer.about');
})->name('about');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/popular', [PopularController::class, 'index'])->name('popular');

// Customers group Routes 
Route::name('customer.')->middleware(['auth'])->group(function () {
    Route::get('/profile/{users:username}', [SettingCustomerController::class, 'profile'])->name('profile.edit');
    Route::put('/profile/alamat/{users:id}', [SettingCustomerController::class, 'dataAlamat'])->name('alamat.update');
    Route::put('/profile/update/{users:id}', [SettingCustomerController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/update/{users:id}', [SettingCustomerController::class, 'updatePwd'])->name('profile.pwdChange');
});

// Keranjang Routes
Route::name('keranjang.')->middleware(['auth'])->group(function() {
    Route::get('/list-cart', [CartController::class, 'list'])->name('list');
    Route::post('/data/cart/store', [CartController::class, 'store'])->name('store');
    Route::put('/data/cart/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/data/cart/destroy/{id}', [CartController::class, 'destroy'])->name('destroy');
});

// ajax services
Route::get('/admin/categories/checkSlug', [DataCategoryController::class, 'checkSlug'])->middleware('admin');
Route::get('/admin/workers/province/{provinces:id}', [DataWorkerController::class, 'getCity'])->middleware('admin');
Route::get('/data/provinsi/{provinces:id}', [SettingCustomerController::class, 'listKota'])->middleware('auth');

// Checkouts Route
Route::name('shipping.')->middleware(['auth'])->group(function() {
    Route::get('/data/city/{provinces:id}', [ShippingController::class, 'getCity'])->name('city');
    Route::get('/destination={city_destination}&weight={weight}&courier={courier}', [ShippingController::class, 'cekOngkir'])->name('check.ongkir');
    Route::get('/shipping/data/create', [ShippingController::class, 'create'])->name('create');
    Route::post('/shipping/data/store', [ShippingController::class, 'store'])->name('store');
});