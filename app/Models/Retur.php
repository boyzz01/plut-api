<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    protected $table = 'histori_retur';
    protected $primaryKey = 'id';
    
    protected $guarded = [
        'id'
    ];
    use HasFactory;
}
