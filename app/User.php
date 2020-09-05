<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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


    public function posts(){
        return $this->hasMany('App\Post', 'post_userid', 'id');
    }

    public function mahasiswa(){
        return $this->hasOne('App\Mahasiswa', 'mhs_user', 'id');
    }

    public function forum(){
        return $this->hasMany('App\Forum', 'forum_user', 'id');
    }

    public function komentar(){
        return $this->hasMany('App\Komentar', 'kmtr_user', 'id');
    }
}
