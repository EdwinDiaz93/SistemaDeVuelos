<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;
    protected $table = 'avions';
    protected $primaryKey = 'idavion';
    protected $guarded=[];

    public function tipoaviones(){
        return $this->hasMany(TipoAvion::class);
    }

    public function aerolineas(){
        return $this->belongsToMany(AeroLinea::class,"aerolinea_avion","aerolinea_cod","avion_id")->withPivot("cantidad");
    }
}
