<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
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
Route::get('/products', [
    ProductsController::class,
    'index'
]);
Route::get('/products/create', [
    ProductsController::class,
    'create'
])->name('products.create');

Route::post('/products/store', [
    ProductsController::class,
    'store'
])->name('products.store');




