<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Produk;
use App\Models\Retur;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
        /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    
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

        // echo $request('nama')."aaa";
        $kota = DB::table('ms_kota')->where('nama','=',$request->kode_kota)->first();
        $no = DB::table('counter')->where('id','=',1)->first();

    
       
        $temp =new Umkm();
        $temp->nama =$request->nama;
        $temp->kode_kota = $kota->kode;
        $temp->nib = $request->nib;
        $temp->kode_umkm = str_pad($no->counter, 3, '0', STR_PAD_LEFT);
       
        $saved = $temp->save();
    

          if(!$saved){
            return response()
            ->json([
                'success' => false,
                'data' =>"Error"
            ]);
          }else{

            $tes = $no->counter+1;
            DB::update("update counter set counter = $tes where id = 1");
            return response()
            ->json([
                'success' => true,
                'data' =>"UMKM Berhasil ditambah"
            ]);
          }
      
    }

    public function get_umkm(){
        return response()->json(Umkm::all());
    }

    
    public function get_produk(){
        return response()->json(Produk::all());
    }

    public function add_produk(Request $request){

        $kategori = DB::table('ms_kategori')->where('nama','=',$request->kategori)->first();
        $umkm = DB::table('umkm')->where('kode_umkm','=',$request->umkm)->first();
        $total = $umkm->total+1;
        $counter = str_pad($total, 4, '0', STR_PAD_LEFT);
        DB::update("update umkm set total = $total where kode_umkm = $request->umkm");
        $kode = $request->kota.$request->umkm.$kategori->kode.$counter;
        $file = $request->file('foto');
        $foto = $request->file('foto')->store('foto');
        $temp =new Produk();
        $temp->nama =$request->nama;
        $temp->kode_produk ="11";
        $temp->harga =$request->harga;
        $temp->stock =$request->stock;
        $temp->kode_umkm =$request->umkm;
        $temp->kode_kota =$request->kota;
        $temp->kode_kategori = $kategori->kode;
        $temp->kode_produk = $kode;

        $url = config('app.url');
        $temp->foto =$url."/storage/app/". $foto;

       
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

         
      
    }

    public function retur_produk(Request $request){

       $produk = DB::table('barang')->where('kode_produk','=',$request->kode)->first();

       $total =  ($produk->stock)-($request->jumlah);
        DB::table('barang')->where('kode_produk','=',$request->kode)->first()->update(array(
            'stock'=>$total,));
        
            $temp =new Retur();
            $temp->kode_produk =$request->kode;
            $temp->user = $request->user;
            $temp->jumlah = $request->$request->jumlah; 
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
                    'data' =>"Produk Berhasil di retur"
                ]);
              }
    
             
    }
}
