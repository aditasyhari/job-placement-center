<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'posisi',
        'jenis',
        'desc',
        'deadline',
        'id_user'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
