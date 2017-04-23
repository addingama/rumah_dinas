<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKPD extends Model
{
    protected $table = 'msSKPD';
    protected $fillable = ['nama', 'created_at', 'updated_at'];
}
