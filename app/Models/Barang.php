<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    public $timestamps = false;
    protected $primarykey = 'kode';
    public $incrementing = false;

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'harga'
    ];
}
