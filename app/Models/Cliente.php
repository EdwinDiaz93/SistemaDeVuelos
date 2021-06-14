<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'idcliente';  
    protected $fillable =[
        'idpersona',
        'estadocivil',
        'genero',
        'nomcontacto',
        'numfrecuente'];

    public function tipoCosto(){

        return $this->belongsTo(Persona::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}
