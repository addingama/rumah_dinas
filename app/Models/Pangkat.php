<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'msPangkatPegawai';

    protected $fillable = ['golongan', 'nama', 'created_at', 'updated_at'];
}
