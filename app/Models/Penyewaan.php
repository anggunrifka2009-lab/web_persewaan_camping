<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';
    protected $primaryKey = 'id_penyewaan';

    protected $fillable = [
        'kode_penyewaan',
        'id_user',
        'tanggal_sewa',
        'tanggal_rencana_kembali',
        'total_harga',
        'jenis_pengambilan',
        'status',
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_rencana_kembali' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detailPenyewaan()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_penyewaan', 'id_penyewaan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_penyewaan', 'id_penyewaan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_penyewaan', 'id_penyewaan');
    }
}