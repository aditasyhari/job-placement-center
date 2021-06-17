<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function infoCompany() {
        return $this->hasOne('App\InfoCompany', 'id_user');
    }

    public function infoUser() {
        return $this->hasOne('App\InfoUser', 'id_user');
    }

    public function job() {
        return $this->hasMany('App\Job', 'id_user');
    }

    public function pendidikan() {
        return $this->hasMany('App\Pendidikan', 'id_user');
    }

    public function skill() {
        return $this->hasMany('App\Skill', 'id_user');
    }

    public function licensi() {
        return $this->hasMany('App\Licensi', 'id_user');
    }

}
