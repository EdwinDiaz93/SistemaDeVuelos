<?php

namespace App\Http\Controllers;


use App\Models\Aeropuerto;
use App\Models\Pais;
use App\Models\Cuidad;
use Illuminate\Http\Request;

class AeropuertoController extends Controller
{
      
    public function index(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
    

            $aeropuertos = Aeropuerto::join('pais','aeropuerto.pais_id','=','pais.id')
            //->join('cuidad','aeropuerto.cuidad_id','=','cuidad.id')
            ->select('aeropuertos.codaeropuerto','aeropuertos.pais_id','aeropuertos.cuidad_id','pais.nompais',
            'cuidad.nomcuidad','aeropuestos.nomaeropuerto','aeropuestos.telefono','aeropuestos.nomresponsable','aeropuestos.numbahias','aeropuertos.estado')
            ->orderBy('aeropuerto.codaeropuerto', 'desc')->paginate(3);
        }
        else{

            $aeropuertos = Aeropuerto::join('pais','aeropuerto.pais_id','=','pais.id')
            //->join('cuidad','aeropuerto.cuidad_id','=','cuidad.id')
            ->select('aeropuertos.codaeropuerto','aeropuertos.pais_id','aeropuertos.cuidad_id','pais.nompais',
            'cuidad.nomcuidad','aeropuestos.nomaeropuerto','aeropuestos.telefono','aeropuestos.nomresponsable','aeropuestos.numbahias','aeropuertos.estado')
            ->where('aeropuertos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('aeropuerto.codaeropuerto', 'desc')->paginate(3);
              
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
         if(!$request->ajax()) return redirect('/');
         $aeropuerto = new Aeropuerto();
         $aeropuerto->codaeropuerto = $request->codigo; // 'codigo, llave primaria de la tabla aeropuerto' 
         $aeropuerto->nomaeropuerto = $request->nombre; 
         $aeropuerto->telefono = $request->celular; 
         $aeropuerto->nomresponsable = $request->responsable; 
         $aeropuerto->numbahias = $request->bahias; 
         $aeropuerto->pais_id = $request->pais; 
         $aeropuerto->cuidad_id = $request->cuidad; 
         $aeropuerto->estado = '1';
         $aeropuerto->save();
    }


   
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $aeropuerto = Aeropuerto::findOrFail($request->codaeropuerto);// 'codigo' es lo que recibimos de la vista
         $aeropuerto->nomaeropuerto = $request->nombre; 
         $aeropuerto->telefono = $request->celular; 
         $aeropuerto->nomresponsable = $request->responsable; 
         $aeropuerto->numbahias = $request->bahias; 
         $aeropuerto->pais_id = $request->pais; 
         $aeropuerto->cuidad_id = $request->cuidad; 
         $aeropuerto->estado = '1';
         $aeropuerto->save();
    }

   
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $aeropuerto = Aeropuerto::findOrFail($request->codaeropuerto); // 'id' dato que viene de la vista
        $aeropuerto->estado = '0';
        $aeropuerto->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $aeropuerto = Aeropuerto::fAndOrFail($request->codaeropuerto);  // 'id' dato que viene de la vista
        $aeropuerto->estado = '1';
        $aeropuerto->save();
    }
}
