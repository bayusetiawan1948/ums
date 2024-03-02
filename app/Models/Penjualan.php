<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    public $timestamps = false;
    protected $primarykey = 'id_nota';
    public $incrementing = false;

    protected $fillable = [
        'id_nota',
        'tgl',
        'kode_pelanggan',
        'subtotal',
    ];
}
