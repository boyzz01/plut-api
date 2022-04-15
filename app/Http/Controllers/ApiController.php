<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Produk;
use App\Models\Retur;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDO;

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
        $temp->kode_umkm = str_pad($no->counter, 4, '0', STR_PAD_LEFT);
       
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

    public function get_produk_shop(Request $request){
   
        $produk = DB::select("SELECT * FROM barang LEFT JOIN keranjang ON barang.kode_produk = keranjang.product_id AND keranjang.user_id = '$request->id_user'");
        $total = DB::select("SELECT COUNT(*) AS total FROM keranjang WHERE user_id = '$request->id_user' AND jumlah > 0");

        return response()
                ->json([
                    'total' => $total[0]->total,
                    $produk
                ]);
      //  return response()->json([$total,$produk]);
    }

    public function detail_produk($id){
        $produk = DB::select("SELECT barang.*,umkm.nama AS 'nama_umkm' FROM `barang` JOIN umkm  WHERE barang.kode_umkm=umkm.kode_umkm AND barang.kode_produk ='$id'");
        return response()->json($produk[0]);
    }

    public function get_cart($id){
        $produk = DB::select("SELECT * FROM `keranjang` JOIN barang ON barang.kode_produk = keranjang.product_id WHERE keranjang.jumlah > 0 AND keranjang.user_id = '$id'");

        return response()->json($produk);
    }

    public function detail_umkm($id){
        return response()->json(Produk::where("kode_umkm",$id)->first());
    }

    public function get_produk_umkm($id){
        $produk = DB::select("SELECT * FROM barang WHERE kode_umkm =  '$id'");
        return response()->json($produk);
      //  return response()->json(Produk::all()->where("kode_umkm",$id));
    }

    public function edit_produk(Request $request){

        if($request->file('foto')==null){
        
            Produk::where('kode_produk',$request->kode)
            ->update(['stock'=>$request->stock,'harga'=>$request->harga,
            'nama'=>$request->nama]);
            $produk = Produk::where("kode_produk",$request->kode)->first();
                return response()
                ->json([
                    'success' => true,
                    'data' =>"oke"
                ]);
        }else{

            $exists = Storage::exists($request->kode.'.jpg');
            $filename  = storage_path('foto').$request->kode.'.jpg';
            
            
           // $foto = $request->file('foto')->storeAs('foto',$request->kode.'.jpg');
            $foto = $request->file('foto')->store('foto');
            $url = config('app.url');
            $temp=$url."/storage/app/". $foto;
            Produk::where('kode_produk',$request->kode)
            ->update(['stock'=>$request->stock,'harga'=>$request->harga,
            'nama'=>$request->nama,'foto'=>$temp]);
            $produk = Produk::where("kode_produk",$request->kode)->first();

            
            if($exists) {
                return response()
                ->json([
                    'success' => true,
                    'data' =>"ok2"
                ]);
            }else{
                return response()
                ->json([
                    'success' => true,
                    'data' =>"ok3"
                ]);
            }
                
        }
      
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
              $produk = Produk::where("kode_produk",$kode)->first();
            return response()
            ->json([
                'success' => true,
                'data' =>$produk
            ]);
          }

         
      
    }

    public function addCart(Request $request){
    
        $validateData = $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'jumlah' => 'required',
        ]);
        Cart::updateOrCreate(['user_id'=>$request->user_id,'product_id'=>$request->product_id],$validateData);

        return response()
        ->json([
            'success' => true,
            'data' =>"Cart Berhasil di update"
        ]);
        //DB::update("update keranjang set stock = $total where kode_produk = $request->kode");
    }

    public function retur_produk(Request $request){

       $produk = DB::table('barang')->where('kode_produk','=',$request->kode)->first();

       $total =  ($produk->stock)-($request->jumlah);
       DB::update("update barang set stock = $total where kode_produk = $request->kode");
       
            $temp =new Retur();
            $temp->kode_produk =$request->kode;
            $temp->user = $request->user;
            $temp->jumlah = $request->jumlah; 
            $temp->keterangan = $request->keterangan;
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
