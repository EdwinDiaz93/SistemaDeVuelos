<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeroLinea extends Model
{
    use HasFactory;
    protected $table = 'aero_lineas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'codaerolinea';
    protected $guarded=[];
    protected $casts = [
        'fechafundacion' => 'datetime:d-m-Y',    
     ];
    
    public function aviones(){
        return $this->hasMany(Avion::class);
    }
    
}
