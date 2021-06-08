<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
   // use HasFactory;
   protected $table = 'Horario';
   protected $primaryKey = 'idhorario';   
   protected $fillable = ['fecha','hora','estado'];

   // iniciando la funcion de la que hace referencia (1 a muchos)
   public function pruebas()
    {
        return $this->hasMany('App\Models\Prueba');
    }
}
