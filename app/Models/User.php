<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idpersona',
        'idrol',
        'usurio',
        'email',
        'password',
        'estado',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol(){
        return $this->belongTo('App\Models\Rol');
    }
  
    public function persona(){
        return $this->belongTo('App\Models\Persona');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
        //'email_verified_at' => 'datetime',
    //];

}
