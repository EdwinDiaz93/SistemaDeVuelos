<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aeropuerto;

class AeropuertoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
    

            $aeropuertos = Aeropuerto::join('pais','aeropuerto.idpais','=','pais.idpais')
            ->join('ciudad','aeropuerto.idciudad','=','ciudad.idciudad')
            ->select('aeropuerto.id','aeropuerto.codaeropuerto','aeropuerto.idpais','aeropuerto.idciudad','pais.nompais','ciudad.nomciudad','aeropuerto.nomaeropuerto','aeropuerto.telefono','aeropuerto.nomresponsable','aeropuerto.numbahias','aeropuerto.estado')
            ->orderBy('aeropuerto.id', 'desc')->paginate(3);
        }
        else{

            $aeropuertos = Aeropuerto::join('pais','aeropuerto.idpais','=','pais.idpais')
            ->join('ciudad','aeropuerto.idciudad','=','ciudad.idciudad')
            ->select('aeropuerto.id','aeropuerto.codaeropuerto','aeropuerto.idpais','aeropuerto.idciudad','pais.nompais','ciudad.nomciudad','aeropuerto.nomaeropuerto','aeropuerto.telefono','aeropuerto.nomresponsable','aeropuerto.numbahias','aeropuerto.estado')
            ->where('aeropuerto.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('aeropuerto.id', 'desc')->paginate(3);
              
        }
        
        return [

            'pagination' => [

                'total'        =>  $aeropuertos->total(),
                'current_page' =>  $aeropuertos->currentPage(),
                'per_page'     =>  $aeropuertos->perPage(),
                'last_page'    =>  $aeropuertos->lastPage(),
                'from'         =>  $aeropuertos->firstItem(),
                'to'           =>  $aeropuertos->lastItem(),
            ],
            'aeropuertos' => $aeropuertos
        ];
       
    }

    public function store(Request $request)
    {
         //
         if(!$request->ajax()) return redirect('/main');
         $aeropuerto = new Aeropuerto();
         $aeropuerto->codaeropuerto = $request->codaeropuerto; // '' 
         $aeropuerto->nomaeropuerto = $request->nomaeropuerto; 
         $aeropuerto->telefono = $request->telefono; 
         $aeropuerto->nomresponsable = $request->nomresponsable; 
         $aeropuerto->numbahias = $request->numbahias; 
         $aeropuerto->idpais = $request->idpais; 
         $aeropuerto->idciudad = $request->idciudad; 
         $aeropuerto->estado = '1';
         $aeropuerto->save();
    }


   
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
         $aeropuerto = Aeropuerto::findOrFail($request->id);// 'codigo' es lo que recibimos de la vista
         $aeropuerto->codaeropuerto = $request->codaeropuerto; 
         $aeropuerto->nomaeropuerto = $request->nomaeropuerto; 
         $aeropuerto->telefono = $request->telefono; 
         $aeropuerto->nomresponsable = $request->nomresponsable; 
         $aeropuerto->numbahias = $request->numbahias; 
         $aeropuerto->idpais = $request->idpais; 
         $aeropuerto->idciudad = $request->idciudad; 
         $aeropuerto->estado = '1';
         $aeropuerto->save();
    }

   
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $aeropuerto = Aeropuerto::findOrFail($request->id); // 'id' dato que viene de la vista
        $aeropuerto->estado = '0';
        $aeropuerto->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $aeropuerto = Aeropuerto::findOrFail($request->id);  // 'id' dato que viene de la vista
        $aeropuerto->estado = '1';
        $aeropuerto->save();
    }
}
