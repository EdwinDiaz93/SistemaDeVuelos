<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'idpersona';  
    protected $fillable =[
    'pnombre',
    'snombre',
    'papellido',
    'sapellido', 
    'fechanaci',
    'direccion',
    'telefono',
    'movil'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function cliente(){
        return $this->hasOne(Cliente::class);
    }

    public function empleado(){
        return $this->hasOne(Empleado::class);
    }
    
}
