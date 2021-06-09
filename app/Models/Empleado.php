<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //use HasFactory;
    protected $table = 'empleado';
    //protected $primaryKey = 'idempleado';   
    protected $fillable = ['puesto','salario','estado'];
  
    public $timestamps = false;
   
    public function persona(){
        return $this->belongTo('App\Models\Persona');
    }
}
