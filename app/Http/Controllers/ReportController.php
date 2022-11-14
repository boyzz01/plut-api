<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function fast(){
        $data= DB::select("SELECT SUM(total_produk) as 'total',transaksi_item.id_product,barang.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product GROUP BY transaksi_item.id_product ORDER by total DESC");
        return response()->json($data);
    }
}
