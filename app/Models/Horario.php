<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
   // use HasFactory;
   protected $table = 'Horario';
   protected $primaryKey = 'idhorario';   
   protected $fillable = ['fecha','hora','estado'];
}
