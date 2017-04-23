<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Pegawai extends Model
{
    protected $table = 'msPegawai';
    protected $fillable = ['nip', 'nama', 'pangkat_id', 'jenis_kelamin', 'telepon', 'jabatan_id', 'skpd_id'];

    public function pangkat() {
        return $this->hasOne('App\Models\Pangkat', 'id', 'pangkat_id');
    }

    public function jabatan() {
        return $this->hasOne('App\Models\Jabatan', 'id', 'jabatan_id');
    }

    public function skpd() {
        return $this->hasOne('App\Models\SKPD', 'id', 'skpd_id');
    }
}
