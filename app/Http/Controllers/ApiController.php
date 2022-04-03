<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'data' =>"User Not Found"
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
        Umkm::create([
            'nama' => $request->nama,
            'kode_kota' =>$request->kode_kota,
            'nib' =>$request->nib
          ]);
        return response()->json(['success'=>'UMKM Berhasil ditambah']);
    }
}
