<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ItemController;    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/health', function () {
    return 'Laravel OK';
});

Route::get('/', function () {
    return redirect('login');
});
Route::view('register','auth.register')->middleware('guest')->name('register');
Route::view('login','auth.login')->middleware('guest')->name('login');
Route::post('store',[RegisterController::class,'store']);

// Route::view('dashboard','dashboard')->middleware('auth')->name('dashboard');


Route::post('authenticate',[LoginController::class,'authenticate']);
Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard (single route)
    // Route::get('login',LoginController::class, 'index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('purchase', PurchaseController::class);
    // Route::resource('purchase-form', PurchaseController::class);
    // Route::resource('purchase-form', PurchaseController::class);
    Route::get('purchase-form', [PurchaseController::class, 'showForm']);


    // Grouped Resources
    Route::resource('customer',CustomerController::class)->except(['show']);
    Route::resource('customer',CustomerController::class)->except(['show']);
    Route::resource('item',ItemController::class)->except(['show']);
    // Route::get('/items', [PurchaseController::class, 'showForm']);
    // Route::resource('purchase', PurchaseController::class)->except(['show']);
});