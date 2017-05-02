<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'msPeminjaman';
    protected $fillable = ['pegawai_id', 'rumah_id', 'harga_sewa', 'start', 'end', 'dasar_pelaksanaan_tarif_sewa', 'tempat_pembayaran', 'is_returned', 'created_at', 'updated_at'];

    public function scopeReturned($query) {
        return $query->where('msPeminjaman.is_returned', '=', 1);
    }

    public function scopeNotReturned($query) {
        return $query->where('msPeminjaman.is_returned', '=', 0);
    }

    public function pegawai() {
        return $this->hasOne('App\Models\Pegawai', 'id', 'pegawai_id');
    }

    public function rumah() {
        return $this->hasOne('App\Models\Rumah', 'id', 'rumah_id');
    }
}
