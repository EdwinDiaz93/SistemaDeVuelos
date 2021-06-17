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
        return $this->BelongsTo(Vuelo::class,"vuelo_id");
    }
    public function cliente(){
        return $this->BelongsTo(Cliente::class,"cliente_id");
    }
    public function pago(){
        return $this->BelongsTo(Pago::class,"pago_id");
    }
}
