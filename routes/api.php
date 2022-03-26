<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App/Http/Controllers/manageProducts;
use App\Http\Controllers\manageProducts;

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

// Route::get('addProductByUser', [manageProducts::class, 'addProductByUser']);
Route::post('addProductByUser', 'manageProducts@addProductByUser');
Route::get('getProducts', 'manageProducts@getProducts');
