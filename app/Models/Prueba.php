<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;
    protected $fillable = ['idhorario','nombrep','estado'];

    // de muchos a una
    public function horario(){
        return $this->belongTo('App\Models\Horario');
    }
}
