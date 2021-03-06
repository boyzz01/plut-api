<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $primaryKey = 'id';
    
    protected $guarded = [
        'id'
    ];
    use HasFactory;
}
