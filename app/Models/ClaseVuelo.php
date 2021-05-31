<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaseVuelo extends Model
{
    //use HasFactory;
    protected $table = 'clase_vuelo';
    protected $primaryKey = 'idclasevuelo';   
    protected $fillable = ['nomclasevuelo','estado'];
}