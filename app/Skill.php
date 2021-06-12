<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $fillable = [
        'nama',
        'id_user',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }
    
}
