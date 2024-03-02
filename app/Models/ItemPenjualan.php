<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;
    protected $table = 'item_penjualan';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_nota',
        'kode_barang',
        'qty'
    ];
}
