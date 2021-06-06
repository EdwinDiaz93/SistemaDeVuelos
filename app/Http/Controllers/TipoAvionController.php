<?php

namespace App\Http\Controllers;

use App\Models\TipoAvion;
use Illuminate\Http\Request;

class TipoAvionController extends Controller
{

    public function index(Request $request)
    {
      //if(!$request->ajax()) return redirect('/');
      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if($buscar==''){
          $tiposavion = TipoAvion::orderBy('idtipoavion', 'desc')->paginate(3);
      }
      else{
          $tiposavion = TipoAvion::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idtipoavion', 'desc')->paginate(3);        
      }
      
      return [

          'pagination' => [

              'total'        =>  $tiposavion->total(),
              'current_page' =>  $tiposavion->currentPage(),
              'per_page'     =>  $tiposavion->perPage(),
              'last_page'    =>  $tiposavion->lastPage(),
              'from'         =>  $tiposavion->firstItem(),
              'to'           =>  $tiposavion->lastItem(),
          ],
          'tiposavion' => $tiposavion 
      ];
    }

    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipoavion = new TipoAvion();
        $tipoavion->nombretipoavion = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $tipoavion->cantidadasientos = $request->cantidad; // 'cantidad' es lo que recibimos de la vista
        $tipoavion->estado = '1';
        $tipoavion->save();
    }

    
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipoavion = TipoAvion::findOrFail($request->tipoavion_id);
        $tipoavion->nombretipoavion = $request->nombre;
        $tipoavion->cantidadasientos = $request->cantidad; // 'cantidad' es lo que recibimos de la vista
        $tipoavion->estado = '1';
        $tipoavion->save();
    }

    
    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/');
        $tipoavion = TipoAvion::findOrFail($request->id); // 'id' dato que viene de la vista
        $tipoavion->estado = '0';
        $tipoavion->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/');
        $tipoavion = TipoAvion::findOrFail($request->id); // 'id' dato que viene de la vista
        $tipoavion->estado = '1';
        $tipoavion->save();
    }
}
