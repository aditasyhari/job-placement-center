<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    //
    protected $fillable = [
        'nama',
        'thn_masuk',
        'thn_keluar',
        'id_user',
    ];
}
