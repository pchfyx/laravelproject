<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Group all product-related routes
Route::controller(ProductController::class)->group(function () {
    // Route to display a list of products
    Route::get('/products', 'index')->name('products'); // Point 5

    // Route to display the create product form
    Route::get('/products/create', 'create')->name('products.create'); // Point 6

    // Route to display the edit product form (requires ID parameter)
    Route::get('/products/edit/{id}', 'edit')->name('products.edit'); // Point 7

    // Route to handle the form submission for creating a new product
    Route::post('/products/store', 'store')->name('products.store'); // Point 8

    // Route to handle the form submission for updating an existing product
    Route::post('/products/update/{id}', 'update')->name('products.update'); // Point 9

    // Route to display a single product's details (requires ID parameter)
    Route::get('/products/show/{id}', 'show')->name('products.show'); // Point 10
    //
    Route::get('/products', [ProductController::class, 'index'])->name('products');

});
