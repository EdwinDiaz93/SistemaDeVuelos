<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClaseVuelo;

class ClaseVueloController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $claseVuelos = ClaseVuelo::orderBy('idclasevuelo', 'desc')->paginate(3);
        }
        else{
            $claseVuelos = ClaseVuelo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idclasevuelo', 'desc')->paginate(3);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $claseVuelos->total(),
                'current_page' =>  $claseVuelos->currentPage(),
                'per_page'     =>  $claseVuelos->perPage(),
                'last_page'    =>  $claseVuelos->lastPage(),
                'from'         =>  $claseVuelos->firstItem(),
                'to'           =>  $claseVuelos->lastItem(),
            ],
            'claseVuelos' => $claseVuelos 
        ];
       
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $claseVuelo = new ClaseVuelo();
        $claseVuelo->nomclasevuelo = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $claseVuelo->estado = '1';
        $claseVuelo->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $claseVuelo = ClaseVuelo::findOrFail($request->claseVuelo_id);
        $claseVuelo->nomclasevuelo = $request->nombre;
        $claseVuelo->estado = '1';
        $claseVuelo->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $claseVuelo = ClaseVuelo::findOrFail($request->id); // 'id' dato que viene de la vista atraves del metodo
        $claseVuelo->estado = '0';
        $claseVuelo->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $claseVuelo = ClaseVuelo::findOrFail($request->id);  // 'id' dato que viene de la vista
        $claseVuelo->estado = '1';
        $claseVuelo->save();
    }
}
