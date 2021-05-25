<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licensi extends Model
{
    //
    protected $fillable = [
        'nama',
        'penerbit',
        'thn_terbit',
        'thn_expired',
        'is_expired',
        'file',
        'id_user',
    ];
}
