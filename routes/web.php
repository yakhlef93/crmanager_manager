<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    // Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    // Route::post('/users/update_password', [App\Http\Controllers\UserController::class, 'update_password'])->name('user.update_password');
    // Route::get('/user/log_activities', [App\Http\Controllers\UserController::class, 'log_activities'])->name('user.log_activities');
    
    // Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    // Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    // Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    // Route::patch('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    // Route::delete('/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    // Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    // Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

    
	// customers
	Route::get('/customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');		
	Route::post('/customers/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
    Route::delete('/customers/{customer}/destroy', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers/{customer}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
    Route::patch('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customers.show');
    
    Route::get('/black_list_customers', [App\Http\Controllers\CustomerBlackListCustomerController::class, 'index_blade'])->name('blacklistcustomers.black_list_customers');

});
    	
// Route::get('/blacklistcustomers/store', [App\Http\Controllers\CustomerBlackListCustomerController::class, 'store'])->name('blacklistcustomers.store');
// Route::get('/blacklistcustomers/index', [App\Http\Controllers\CustomerBlackListCustomerController::class, 'index'])->name('blacklistcustomers.index');
// Route::get('/blacklistcustomers/update', [App\Http\Controllers\CustomerBlackListCustomerController::class, 'update'])->name('blacklistcustomers.update');