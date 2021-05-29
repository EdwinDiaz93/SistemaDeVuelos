<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAvion extends Model
{
    use HasFactory;
    protected $table = 'tipo_avions';
    protected $primaryKey = 'idtipoavion';
    protected $guarded=[];
}
