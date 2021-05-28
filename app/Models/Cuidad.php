<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuidad extends Model
{
    use HasFactory;
    protected $table = 'cuidad';
    protected $primaryKey = 'id';
    protected $guarded=[];



    //relacion uno a muchos 
    public function aeropuerto(){
        return $this->hasMany('App\Models\Aeropuerto');

    }
    //relacion uno a muchos a pais inversa
    public function pais(){
        return $this->belongsTo('App\Models\Pais');
    }
  

}
