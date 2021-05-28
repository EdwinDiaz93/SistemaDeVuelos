<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = 'pais';
    protected $primaryKey = 'id';
    protected $guarded=[];

    //relacion uno a muchos a aeropuerto
    public function aeropuerto(){
        return $this->hasMany('App\Models\Aeropuerto');
    }
    
}
