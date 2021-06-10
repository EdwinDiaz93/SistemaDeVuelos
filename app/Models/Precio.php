<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'precios';
    protected $primaryKey = 'idprecio';
    protected $guarded=[];
}
