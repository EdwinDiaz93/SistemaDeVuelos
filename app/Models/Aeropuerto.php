<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuerto';
    protected $primaryKey = 'id';      
    protected $fillable =['codaeropuerto','nomaeropuerto','nomresponsable','telefono' ,'numbahias','idpais','idciudad','estado'];

     //relacion uno a muchos inversa a pais
     public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

      //relacion uno a muchos inversa a cuidad
      public function pais(){
        return $this->belongsTo(Pais::class);
    }
}
