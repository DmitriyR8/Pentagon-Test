<?php

use App\Http\Controllers\OauthController;
use App\Http\Controllers\DataParserController;
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

Route::get('/', [OauthController::class, 'index'])->name('index');
Route::post('login', [OauthController::class, 'login'])->name('login');
Route::post('logout', [OauthController::class, 'logout'])->name('logout');
Route::post('parse', [DataParserController::class, 'parseData'])->name('parse');
Route::get('orders', [DataParserController::class, 'getOrders'])->name('orders');
Route::get('products', [DataParserController::class, 'getProducts'])->name('products');
