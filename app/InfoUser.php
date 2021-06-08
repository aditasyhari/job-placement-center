<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    //
    protected $fillable = [
        'nim',
        'nama',
        'gender',
        'tgl_lahir',
        'tempat_lahir',
        'alamat',
        'nik',
        'profile',
        'berat',
        'tinggi',
        'telp',
        'desc',
        'id_user'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }
}
