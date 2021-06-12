<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = 'vuelos';
    protected $primaryKey = 'idvuelo';
    protected $guarded=[];

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }


    public function aerolineas(){
        return $this->hasMany(Aerolinea::class);
    }

    public function aeropuertos(){
        return $this->hasMany(Aeropuerto::class);
    }
    public function clasevuelos(){
        return $this->hasMany(ClaseVuelo::class);
    }

    public function precios(){
        return $this->hasMany(Precio::class);
    }

    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    public function costos(){
        return $this->hasMany(Costo::class);
    }


}
