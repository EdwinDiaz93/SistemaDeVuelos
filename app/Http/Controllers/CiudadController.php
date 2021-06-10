<?php

namespace App\Http\Controllers;
use App\Models\Ciudad;

use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function selectCiudad(Request $request){

      

        if(!$request->ajax()) return redirect('/main');
        $ciudad = Ciudad::where('estado','=','1')    //selecciona solo las tipos de costos activos
        ->select('idciudad','nomciudad')->orderBy('nomciudad', 'asc')->get();
        return ['ciudad' => $ciudad];
}
}


