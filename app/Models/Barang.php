<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'kode_barang',
        'nama_barang',
        'deskripsi',
        'harga_sewa',
        'stok',
        'foto',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function detailPenyewaan()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_barang', 'id_barang');
    }
}