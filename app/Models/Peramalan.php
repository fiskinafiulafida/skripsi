<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    use HasFactory;
    protected $table = 'peramalan';
    protected $guarded = [];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'namakandang_id');
    }
}
