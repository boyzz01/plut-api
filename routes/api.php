<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ReportController;
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
Route::get('get_cart/{id}',[ApiController::class, 'get_cart']);
Route::get('produk',[ApiController::class, 'get_produk']);
Route::post('produk_shop',[ApiController::class, 'get_produk_shop']);
Route::get('produk_umkm/{id}',[ApiController::class, 'get_produk_umkm']);
Route::get('get_transaksi/{id}',[ApiController::class, 'get_transaksi']);
Route::get('detail_produk/{id}',[ApiController::class, 'detail_produk']);
Route::get('detail_umkm/{id}',[ApiController::class, 'detail_umkm']);
Route::any('/login', [ApiController::class,'check_user'] );
Route::get('history',[ApiController::class, 'get_history']);
Route::get('get_laporan',[ApiController::class, 'get_laporan']);
Route::get('detail_laporan/{id}',[ApiController::class, 'detail_laporan']);
Route::post('/add_umkm', [ApiController::class,'addUmkm'] );
Route::post('/add_cart', [ApiController::class,'addCart'] );
Route::post('/add_produk', [ApiController::class,'add_produk'] );
Route::post('/edit_produk', [ApiController::class,'edit_produk'] );
Route::post('/retur', [ApiController::class,'retur_produk'] );
Route::post('/add_transaksi', [ApiController::class,'add_transaksi'] );

Route::post('/hapus_umkm', [ApiController::class,'hapus_umkm'] );


Route::get('transaksi_user/{id}',[ApiController::class, 'transaksi_user']);


Route::get("fast",[ReportController::class,"fast"]);
Route::get("all",[ReportController::class,"all"]);
Route::get("slow",[ReportController::class,"slow"]);
Route::get("umkm",[ReportController::class,"umkm"]);
Route::get("kota",[ReportController::class,"kota"]);
Route::get("kategori",[ReportController::class,"kategori"]);

Route::get("stock_all",[ReportController::class,"stock_all"]);
Route::get("stock_umkm",[ReportController::class,"stock_umkm"]);
Route::get("stock_kategori",[ReportController::class,"stock_kategori"]);
Route::get("stock_outdate",[ReportController::class,"stock_outdate"]);
Route::get("stock_zero",[ReportController::class,"stock_zero"]);
