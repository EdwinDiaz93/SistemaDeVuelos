<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = 'pais';
    protected $primaryKey = 'idpais';   
    protected $fillable = ['nompais','estado'];

    //relacion uno a muchos a aeropuerto
    public function aeropuerto(){
        return $this->hasMany(Aeropuerto::class);
    }

    public function ciudades(){
        return $this->hasMany(Ciudad::class);
    }
}
