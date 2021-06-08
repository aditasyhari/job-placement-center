<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoCompany extends Model
{
    //
    protected $fillable = [
        'nama',
        'npwp',
        'alamat',
        'fax',
        'no_telp',
        'website',
        'profile',
        'desc',
        'id_user',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }
}
