<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;


class PaisController extends Controller
{
    public function selectPais( Request $request) 
    {
        if(!$request->ajax()) return redirect('/');
        $pais= Pais::all()    //selecciona solo los roles activos
        ->select('id','nompais')->orderBy('nompais', 'asc')->get();
        return ['pais  ' => $pais];
    }

}
