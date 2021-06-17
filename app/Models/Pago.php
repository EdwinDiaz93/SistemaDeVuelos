<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'idpago';
    protected $guarded=[];
    protected $casts = [
        'fechavencimiento' => 'datetime:d-m-Y',    
     ];
    public function reserva(){
        return $this->hasOne(Reserva::class);
    }
}
