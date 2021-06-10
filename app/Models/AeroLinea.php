<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeroLinea extends Model
{
    use HasFactory;
    protected $table = 'aero_lineas';
    public $incrementing = false;
    protected $primaryKey = 'codaerolinea';
    protected $guarded=[];

    public function redes(){
        return $this->belongsToMany(RedSocial::class,"aerolinea_redsocial","aerolinea_cod","redsocial_id")->withPivot("url");
    }

    public function aviones(){
        return $this->hasMany(Avion::class);
    }
    
}
