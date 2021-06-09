<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costos extends Model
{
    //use HasFactory;
    protected $table = 'costos';
    protected $primaryKey = 'idcosto';  
    protected $fillable =['idtipocosto','cantidad','descripcion','estado'];

    public function tipoCosto(){

        return $this->belongsTo(TipoCosto::class);
    }
}
