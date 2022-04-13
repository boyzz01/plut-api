<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_cart';
    
    protected $fillable = [
        'product_id',
        'user_id',
        'jumlah',
    ];
    use HasFactory;
}
