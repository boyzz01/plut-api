<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function fast(){
        $data= DB::select("SELECT SUM(total_produk) as 'total',transaksi_item.id_product,barang.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product GROUP BY transaksi_item.id_product ORDER by total DESC, barang.nama ASC");
      //  return response()->json($data);
      return view('report_fast',['data'=>$data]);
    }

    public function slow(){
        $data= DB::select("SELECT SUM(total_produk) as 'total',transaksi_item.id_product,barang.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product GROUP BY transaksi_item.id_product ORDER by total ASC, barang.nama ASC");
        return response()->json($data);
    }

    public function umkm(){
        $data= DB::select("SELECT SUM(transaksi_item.total_produk) as 'total',transaksi_item.id_product,umkm.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product JOIN umkm ON barang.kode_umkm = umkm.kode_umkm GROUP BY umkm.kode_umkm ORDER by total DESC, barang.nama ASC");
        return response()->json($data);
    }

    public function kota(){
        $data= DB::select("SELECT SUM(transaksi_item.total_produk) as 'total',transaksi_item.id_product,ms_kota.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product  JOIN ms_kota ON ms_kota.kode = barang.kode_kota GROUP BY barang.kode_kota ORDER by total DESC, barang.nama ASC");
        return response()->json($data);
    }

    public function kategori(){
        $data= DB::select("SELECT SUM(transaksi_item.total_produk) as 'total',transaksi_item.id_product,ms_kategori.* FROM transaksi_item JOIN barang ON barang.kode_produk = transaksi_item.id_product  JOIN ms_kategori ON ms_kategori.kode = barang.kode_kategori GROUP BY barang.kode_kota ORDER by total DESC, barang.nama ASC");
        return response()->json($data);
    }

    public function stock_all(){
        $data = DB::select("SELECT * FROM `barang` ORDER BY updated_at ASC");
        return response()->json($data);
    }

    public function stock_umkm(){
        $data = DB::select("SELECT SUM(barang.stock) AS 'total',umkm.* FROM barang JOIN umkm ON barang.kode_umkm = umkm.kode_umkm GROUP BY umkm.kode_umkm ORDER by total DESC, barang.nama ASC");
        return response()->json($data);
    }

    public function stock_kategori(){
        $data = DB::select("SELECT SUM(barang.stock) AS 'total',ms_kategori.* FROM barang JOIN ms_kategori ON barang.kode_kategori = ms_kategori.kode GROUP BY ms_kategori.kode ORDER by total DESC, barang.nama ASC");
        return response()->json($data);
    }

    public function stock_outdate(){
        $data = DB::select("SELECT * FROM `barang` ORDER BY updated_at DESC");
        return response()->json($data);
    }

    public function stock_zero(){
        $data = DB::select("SELECT * FROM barang WHERE stock = 0");
        return response()->json($data);
    }
}
