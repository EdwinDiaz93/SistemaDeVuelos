<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    use HasFactory;
    protected $table = 'red_socials';
    protected $primaryKey = 'idredsocial';
    protected $guarded=[];
    
    public function aerolineas(){
        return $this->belongsToMany(AeroLinea::class,"aerolinea_redsocial","redsocial_id","aerolinea_cod")->withPivot("url");
    }
    
}
