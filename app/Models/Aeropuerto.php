<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    use HasFactory;
    protected $table = 'aeropuerto';
    public $incrementing = false;
    protected $primaryKey = 'codAeropuerto';
    protected $guarded=[];


    //relacion uno a muchos inversa a pais
    public function cuidad(){
        return $this->belongsTo('App\Models\Cuidad');
    }

      //relacion uno a muchos inversa a cuidad
      public function pais(){
        return $this->belongsTo('App\Models\Pais');
    }
}
