<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;
    protected $table = 'avions';
    protected $primaryKey = 'idAvion';
    protected $guarded=[];

    public function tipoaviones(){
        return $this->hasMany(TipoAvion::class);
    }
}
