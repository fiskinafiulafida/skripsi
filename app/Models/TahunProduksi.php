<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunProduksi extends Model
{
    use HasFactory;

    protected $table = 'tahun_produksi';
    protected $guarded = ['id'];
}
