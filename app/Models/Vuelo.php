<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;


    public function aerolinea(){
        return $this->belongsTo(Aerolinea::class);
    }

    public function aeropuerto(){
        return $this->belongsTo(Aeropuerto::class);
    }
    public function clasevuelo(){
        return $this->belongsTo(ClaseVuelo::class);
    }

    public function clasevuelo(){
        return $this->belongsTo(Precio::class);
    }

    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    public function horarios(){
        return $this->belongsTo(Costo::class);
    }


}
