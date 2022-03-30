<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function get_all_kota(){
        return response()->json(Kota::all());
    }

    public function get_kategori(){
        return response()->json(Kategori::all());
    }
}
