<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $fillable = ['pnompre','snombre','papellido','sapellido','fechanaci','direccion','telefono','movil'];

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

}
