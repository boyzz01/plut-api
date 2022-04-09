<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Produk;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function get_all_kota(){
        return response()->json(Kota::all());
    }

    public function get_kategori(){
        return response()->json(Kategori::all());
    }

    public function check_user(Request $request)
    {

        $user = User::where('username',$request->username)->where('password',$request->password)->first();

        
        if($user==null){
            return response()
            ->json([
                'success' => false,
                'data' =>$user
            ]);
        }else{
            return response()
                ->json([
                    'success' => true,
                    'data' =>$user
                ]);
           
        }
        
      
      
    }

    public function addUmkm(Request $request){

        echo $request->kode_kota;
        // $kota = DB::table('ms_kota')->where('nama','=',$request->kode_kota)->first();
        // $file = $request->file('file');
        // $temp =new Umkm();
        // $temp->nama =$request->nama;
        // $temp->kode_kota = $kota->kode;
        // $temp->nib = $request->nib;
        // $temp->foto = $file->getRealPath();

        // // $saved = $temp->save();
    

        //   if(!$saved){
        //     return response()
        //     ->json([
        //         'success' => false,
        //         'data' =>"Error"
        //     ]);
        //   }else{
        //     return response()
        //     ->json([
        //         'success' => true,
        //         'data' =>"UMKM Berhasil ditambah"
        //     ]);
        //   }
      
    }

    public function get_umkm(){
        return response()->json(Umkm::all());
    }

    
    public function get_produk(){
        return response()->json(Produk::all());
    }

    public function add_produk(Request $request){

        $kategori = DB::table('ms_kategori')->where('nama','=',$request->kategori)->first();
        $temp =new Produk();
        $temp->nama =$request->nama;
        $temp->kode_produk ="11";
        $temp->harga =$request->harga;
        $temp->stock =$request->stock;
        $temp->kode_umkm =$request->umkm;
        $temp->kode_kota =$request->kota;
        $temp->kode_kategori = "00";
       
        $saved = $temp->save();
    

          if(!$saved){
            return response()
            ->json([
                'success' => false,
                'data' =>"Error"
            ]);
          }else{
            return response()
            ->json([
                'success' => true,
                'data' =>"UMKM Berhasil ditambah"
            ]);
          }

          return response()
            ->json([
                'success' => true,
                'data' =>"gagal"
            ]);
      
    }
}
