<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    public $timestamps = false;
    protected $primarykey = 'kode';
    public $incrementing = false;

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'domisili',
        'jenis_kelamin'
    ];
}
