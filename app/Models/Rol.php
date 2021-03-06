<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //use HasFactory;
    protected $table = 'rol';
    protected $primaryKey = 'idrol';   
    protected $fillable = ['nomrol','descripcion', 'estado'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
