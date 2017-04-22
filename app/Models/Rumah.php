<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'msRumah';
    protected $fillable = ['alamat', 'kondisi', 'keterangan', 'tipe_rumah_id', 'created_at', 'updated_at'];


}
