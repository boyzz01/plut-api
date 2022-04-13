<?php

use App\Http\Controllers\ApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('kota',[ApiController::class, 'get_all_kota']);
Route::get('kategori',[ApiController::class, 'get_kategori']);
Route::get('umkm',[ApiController::class, 'get_umkm']);
Route::get('produk',[ApiController::class, 'get_produk']);
Route::post('produk_shop',[ApiController::class, 'get_produk_shop']);
Route::get('produk_umkm/{id}',[ApiController::class, 'get_produk_umkm']);
Route::get('detail_produk/{id}',[ApiController::class, 'detail_produk']);
Route::get('detail_umkm/{id}',[ApiController::class, 'detail_umkm']);
Route::any('/login', [ApiController::class,'check_user'] );
Route::post('/add_umkm', [ApiController::class,'addUmkm'] );
Route::post('/add_cart', [ApiController::class,'addCart'] );
Route::post('/add_produk', [ApiController::class,'add_produk'] );
Route::post('/edit_produk', [ApiController::class,'edit_produk'] );
Route::post('/retur', [ApiController::class,'retur_produk'] );
