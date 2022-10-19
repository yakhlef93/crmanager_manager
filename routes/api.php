<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiRessource('blacklistcustomers', App\Http\Controllers\CustomerBlackListCustomerController::class);
Route::resource('/blacklistcustomers', App\Http\Controllers\CustomerBlackListCustomerController::class);
Route::delete('/blacklistcustomers/delete', [App\Http\Controllers\CustomerBlackListCustomerController::class,'delete']);

Route::post('/customers/update', [App\Http\Controllers\CustomerController::class,'remote_update']);
