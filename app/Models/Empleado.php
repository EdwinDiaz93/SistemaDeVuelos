<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'idempleado';  
    protected $fillable =[
        'idpersona',
        'puesto',
        'salario'];

    public $timestamps = false;

    public function persona(){

        return $this->belongsTo(Persona::class);
    }
}
 
