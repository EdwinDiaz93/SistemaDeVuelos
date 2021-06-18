<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Models\TipoAvion;
use App\Models\AeroLinea;
use Illuminate\Http\Request;

class AvionController extends Controller
{
    
     
    public function index(Request $request)
    {
        //  if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

      if($buscar==''){
          $tiposavion = TipoAvion::where("estado","=","1")->orderBy('idtipoavion', 'desc')->paginate(3);
          $aviones=Avion::with("tipoavion","aerolineas")->orderBy('idavion', 'desc')->paginate(10);
          $aerolineas=AeroLinea::where("estado","=","1")->orderBy('codaerolinea', 'desc')->paginate(3);
      }
      else{ 
        $tiposavion = TipoAvion::where("estado","=","1")->orderBy('idtipoavion', 'desc')->paginate(3);
        $aerolineas=AeroLinea::where("estado","=","1")->orderBy('codaerolinea', 'desc')->paginate(3);         
        $aviones = Avion::where($criterio, 'like', '%'. $buscar . '%')->with("tipoavion","aerolineas")->orderBy('idavion', 'desc')->paginate(3);          
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
          'tiposavion' => $tiposavion,
          'aerolineas' => $aerolineas,
      ];
    }

     
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $avion = new Avion();
        $avion->modeloavion = $request->modeloavion; 
        $avion->marcaavion = $request->marcaavion;         
        $avion->cantidad = $request->cantidad;         
        $avion->aerolinea_cod = $request->aerolinea_cod;         
        $avion->estado = '1'; 
        $avion->tipoavion_id =$request->tipoavion_id;
        $avion->save();
    }

  
     
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $avion = Avion::findOrFail($request->idavion);
        $avion->modeloavion = $request->modeloavion; 
        $avion->marcaavion = $request->marcaavion;
        $avion->cantidad = $request->cantidad;         
        $avion->aerolinea_cod = $request->aerolinea_cod;   
        $avion->estado = '1'; 
        $avion->tipoavion_id =$request->tipoavion_id;
        $avion->save();
    }

   
    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $avion = Avion::findOrFail($request->id); // 'id' dato que viene de la vista
        $avion->estado = '0';
        $avion->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $avion = Avion::findOrFail($request->id); // 'id' dato que viene de la vista
        $avion->estado = '1';
        $avion->save();
    }
}
