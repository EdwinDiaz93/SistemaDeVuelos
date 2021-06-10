<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudad';
    protected $primaryKey = 'idciudad';   
    protected $fillable = ['nomciudad','estado','idpais'];
    

     //relacion uno a muchos 
     public function aeropuerto(){
        return $this->hasMany(Aeropuerto::class);

    }
    //relacion uno a muchos a pais inversa
    public function pais(){
        return $this->belongsTo(Pais::class);
    }
}
