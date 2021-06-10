<?php

namespace App\Http\Controllers;
use App\Models\Pais;

use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function selectPais(Request $request){
        if(!$request->ajax()) return redirect('/main');
        $pais = Pais::where('estado','=','1')    //selecciona solo las tipos de costos activos
        ->select('idpais','nompais')->orderBy('nompais', 'asc')->get();
        return ['pais' => $pais];
}
}
