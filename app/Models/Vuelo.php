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
        return $this->hasOne(Reserva::class);
    }


    public function aerolinea(){
        return $this->BelongsTo(Aerolinea::class,"aerolinea_cod");
    }

    public function aeropuertoida(){
        return $this->BelongsTo(Aeropuerto::class,"idaeropuertoida");
    }
    public function aeropuertoreg(){
        return $this->BelongsTo(Aeropuerto::class,"idaeropuertoregreso");
    }
    public function clasevuelo(){
        return $this->BelongsTo(ClaseVuelo::class,"");
    }

    public function precio(){
        return $this->BelongsTo(Precio::class,"idprecio");
    }

    public function horarioida(){
        return $this->BelongsTo(Horario::class,"idhorariosalida");
    }
    public function horarioreg(){
        return $this->BelongsTo(Horario::class,"idhorarioregreso");
    }

    public function costo(){
        return $this->BelongsTo(Costos::class,"costo_id");
    }


}
