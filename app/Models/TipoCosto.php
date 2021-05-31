<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCosto extends Model
{
    //use HasFactory;
    protected $table = 'tipo_costo';
    protected $primaryKey = 'idtipocosto';   
    protected $fillable = ['nomtipocosto','estado'];
}
