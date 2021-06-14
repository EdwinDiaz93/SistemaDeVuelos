<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'idreserva';
    protected $guarded=[];

    public function vuelo(){
        return $this->hasOne(Vuelo::class);
    }
    public function cliente(){
        return $this->hasOne(Cliente::class);
    }
    public function pago(){
        return $this->hasOne(Pago::class);
    }
}
