<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
 
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/special-offers', 'UserController@storeDiscount')->name('special_offers');
Route::get('/payment/success', [UserController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [UserController::class, 'paymentCancel'])->name('payment.cancel');

Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');

Route::get('/store', [UserController::class, 'store'])->name('store');

Route::get('/cash_order', [UserController::class, 'cash_order']);

Route::get('/stripe/{totaleprice}', [UserController::class, 'stripe']);

Route::post('stripe/{totaleprice}', [UserController::class, 'stripePost'])->name('stripe.post');

Route::post('/session', 'App\Http\Controllers\UserController@session')->name('session');
Route::get('/success', 'App\Http\Controllers\UserController@success')->name('success');

Route::get('/cart', [AuthController::class, 'cart'])->name('cart');
Route::delete('cart/{cart}', [AuthController::class, 'destroy_cart'])->name('cart.destroy');
Route::post('/cart/update', 'HomeController@update')->name('cart.update');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
 
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
   
   
});
 
//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
    Route::put('/user/update/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::post('/add_cart/{id}', [UserController::class, 'add_cart']);
});
 


//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
   
 
    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');

    Route::get('/admin/category', [AdminController::class, 'categorypage'])->name('admin/category');
    Route::get('/admin/order', [AdminController::class, 'orderpage'])->name('admin/order');
    Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
    Route::post('/add_category', [AdminController::class, 'add_category']);
    Route::get('/delete_catagory/{id}', [AdminController::class, 'delete_category']);
    Route::get('/view_product', [AdminController::class, 'view_product']);
    Route::post('/add_product', [AdminController::class, 'add_product']);
    Route::get('/show_product', [AdminController::class, 'show_product']);
    Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
    Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::put('/update_product/{id}', [AdminController::class, 'update_product'])->name('update_product');
 

   
});