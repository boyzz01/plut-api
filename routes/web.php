<?php

use App\Http\Controllers\ApiController;
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

Route::post('/add_umkm', [ApiController::class,'addUmkm'] );

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