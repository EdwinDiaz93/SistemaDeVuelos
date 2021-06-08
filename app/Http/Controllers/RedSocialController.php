<?php

namespace App\Http\Controllers;

use App\Models\RedSocial;
use Illuminate\Http\Request;

class RedSocialController extends Controller
{
    
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $redes = RedSocial::orderBy('idredsocial', 'desc')->paginate(3);
        }
        else{
            $redes = RedSocial::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idredsocial', 'desc')->paginate(3);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $redes->total(),
                'current_page' =>  $redes->currentPage(),
                'per_page'     =>  $redes->perPage(),
                'last_page'    =>  $redes->lastPage(),
                'from'         =>  $redes->firstItem(),
                'to'           =>  $redes->lastItem(),
            ],
            'redes' => $redes 
        ];
    }

          
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $redsocial = new RedSocial();
        $redsocial->nombreredsocial = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $redsocial->estado = '1';
        $redsocial->save();
    }

   
    
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $redsocial = RedSocial::findOrFail($request->redsocial_id);
        $redsocial->nombreredsocial = $request->nombre;
        $redsocial->estado = '1';
        $redsocial->save();
    }

   
    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $redsocial = RedSocial::findOrFail($request->id); // 'id' dato que viene de la vista
        $redsocial->estado = '0';
        $redsocial->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $redsocial = RedSocial::findOrFail($request->id); // 'id' dato que viene de la vista
        $redsocial->estado = '1';
        $redsocial->save();
    }

  
}
