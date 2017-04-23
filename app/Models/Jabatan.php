<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'msJabatan';
    protected $fillable = ['nama', 'created_at', 'updated_at'];
}
