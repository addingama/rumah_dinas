<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'msRumah';
    protected $fillable = ['alamat', 'kondisi', 'keterangan', 'tipe_rumah_id', 'is_available', 'created_at', 'updated_at'];

    public function tipe() {
        return $this->hasOne('App\Models\TipeRumah', 'id', 'tipe_rumah_id');
    }
}
