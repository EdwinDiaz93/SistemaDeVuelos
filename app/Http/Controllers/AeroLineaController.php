<?php

namespace App\Http\Controllers;

use App\Models\AeroLinea;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class AeroLineaController extends Controller
{
   
    public function index(Request $request)
    {
          //  if(!$request->ajax()) return redirect('/main');
          $buscar = $request->buscar;
          $criterio = $request->criterio;
  
        if($buscar==''){                
            $ciudades=Ciudad::with("pais")->orderBy('idciudad', 'desc')->paginate(10);
            $aerolineas=AeroLinea::orderBy('codaerolinea', 'desc')->paginate(3);
        }
        else{          
            $aerolineas = AeroLinea::where($criterio, 'like', '%'. $buscar . '%')->orderBy('codaerolinea', 'desc')->paginate(3);          
        }
        
        return [
  
            'pagination' => [
  
                'total'        =>  $aerolineas->total(),
                'current_page' =>  $aerolineas->currentPage(),
                'per_page'     =>  $aerolineas->perPage(),
                'last_page'    =>  $aerolineas->lastPage(),
                'from'         =>  $aerolineas->firstItem(),
                'to'           =>  $aerolineas->lastItem(),
            ],            
            'ciudades'=>$ciudades,            
            'aerolineas'=>$aerolineas,            
        ];
    }

  
    public function store(Request $request)
    {           
        if(!$request->ajax()) return redirect('/main');
        $aerolinea = new AeroLinea();
        $aerolinea->codaerolinea = $request->codaerolinea; 
        $aerolinea->nombreaerolinea = $request->nombreaerolinea;         
        $aerolinea->nombreoficial = $request->nombreoficial;         
        $aerolinea->nombrecorto = $request->nombrecorto;         
        $aerolinea->facebook= $request->facebook;
        $aerolinea->twitter= $request->twitter;
        $aerolinea->instagram= $request->instagram;
        $aerolinea->nombrerepresentante = $request->nombrerepresentante;         
        $aerolinea->idciudad=$request->idciudad;
        $aerolinea->fechafundacion = $request->fechafundacion;
        $aerolinea->estado = '1';         
        $aerolinea->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $aerolinea = AeroLinea::findOrFail($request->codaerolinea);        
        $aerolinea->nombreaerolinea = $request->nombreaerolinea;         
        $aerolinea->nombreoficial = $request->nombreoficial;         
        $aerolinea->nombrecorto = $request->nombrecorto;    
        $aerolinea->facebook= $request->facebook;
        $aerolinea->twitter= $request->twitter;
        $aerolinea->instagram= $request->instagram;     
        $aerolinea->nombrerepresentante = $request->nombrerepresentante;         
        $aerolinea->idciudad=$request->idciudad;  
        $aerolinea->fechafundacion = $request->fechafundacion;       
        $aerolinea->estado = '1'; 
        $aerolinea->save();
    }

    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $aerolinea = AeroLinea::findOrFail($request->id); // 'id' dato que viene de la vista
        $aerolinea->estado = '0';
        $aerolinea->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $aerolinea = AeroLinea::findOrFail($request->id); // 'id' dato que viene de la vista
        $aerolinea->estado = '1';
        $aerolinea->save();
    }
}
