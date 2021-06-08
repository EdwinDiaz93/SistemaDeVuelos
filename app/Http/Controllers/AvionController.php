<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Models\TipoAvion;
use Illuminate\Http\Request;

class AvionController extends Controller
{
    
     
    public function index()
    {
         //if(!$request->ajax()) return redirect('/');
      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if($buscar==''){
          $tiposavion = TipoAvion::orderBy('idtipoavion', 'desc')->paginate(3);
          $aviones=Avion::orderBy('idavion', 'desc')->paginate(3);
      }
      else{          
          $aviones = Avion::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idavion', 'desc')->paginate(3);
      }
      
      return [

          'pagination' => [

              'total'        =>  $aviones->total(),
              'current_page' =>  $aviones->currentPage(),
              'per_page'     =>  $aviones->perPage(),
              'last_page'    =>  $aviones->lastPage(),
              'from'         =>  $aviones->firstItem(),
              'to'           =>  $aviones->lastItem(),
          ],
          'aviones'=>$aviones,
          'tiposavion' => $tiposavion
      ];
    }

     
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $avion = new Avion();
        $avion->modeloavion = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $avion->marcaavion = $request->cantidad; // 'cantidad' es lo que recibimos de la vista
        $avion->estado = '1'; // 'cantidad' es lo que recibimos de la vista
        $avion->tipoavion_id =$request->tipoavion_id;
        $avion->save();
    }

  
     
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $avion = Avion::findOrFail($request->avion_id);
        $avion->modeloavion = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $avion->marcaavion = $request->cantidad; // 'cantidad' es lo que recibimos de la vista
        $avion->estado = '1'; // 'cantidad' es lo que recibimos de la vista
        $avion->tipoavion_id =$request->tipoavion_id;
        $avion->save();
    }

   
    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/');
        $avion = Avion::findOrFail($request->id); // 'id' dato que viene de la vista
        $avion->estado = '0';
        $avion->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/');
        $avion = Avion::findOrFail($request->id); // 'id' dato que viene de la vista
        $avion->estado = '1';
        $avion->save();
    }
}
