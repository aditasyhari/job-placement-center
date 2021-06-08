<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'id_job',
        'id_pelamar',
        'id_company',
        'status',
        'baca_perusahaan',
        'baca_pelamar'
    ];

    public function job() {
        return $this->belongsTo('\App\Job', 'id');
    }

}
