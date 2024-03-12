<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi_telur';
    protected $guarded = ['id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'namakandang_id');
    }

    public function tahunProduksi()
    {
        return $this->belongsTo(TahunProduksi::class, 'tahunProduksi_id');
    }
}
