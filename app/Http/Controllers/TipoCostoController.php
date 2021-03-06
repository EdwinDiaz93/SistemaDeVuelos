<?php

namespace App\Http\Controllers;
use App\Models\TipoCosto;

use Illuminate\Http\Request;

class TipoCostoController extends Controller
{
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $tipoCostos = TipoCosto::orderBy('idtipocosto', 'desc')->paginate(3);
        }
        else{
            $tipoCostos = TipoCosto::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idtipocosto', 'desc')->paginate(3);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $tipoCostos->total(),
                'current_page' =>  $tipoCostos->currentPage(),
                'per_page'     =>  $tipoCostos->perPage(),
                'last_page'    =>  $tipoCostos->lastPage(),
                'from'         =>  $tipoCostos->firstItem(),
                'to'           =>  $tipoCostos->lastItem(),
            ],
            'tipoCostos' => $tipoCostos 
        ];
       
    }

    public function selectTipoCosto(Request $request){
        if(!$request->ajax()) return redirect('/main');
        $tipoCostos = TipoCosto::where('estado','=','1')    //selecciona solo las tipos de costos activos
        ->select('idtipocosto','nomtipocosto')->orderBy('nomtipocosto', 'asc')->get();
        return ['tipoCostos' => $tipoCostos];
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $tipoCosto = new TipoCosto();
          //$rol = Rol::select( "call ps_inser_tcosto('?','?')");
        $tipoCosto->nomtipocosto = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $tipoCosto->estado = '1';
        $tipoCosto->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $tipoCosto = TipoCosto::findOrFail($request->tipoCosto_id);
        $tipoCosto->nomtipocosto = $request->nombre;
        $tipoCosto->estado = '1';
        $tipoCosto->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $tipoCosto = TipoCosto::findOrFail($request->id); // 'id' dato que viene de la vista
        $tipoCosto->estado = '0';
        $tipoCosto->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $tipoCosto = TipoCosto::findOrFail($request->id);  // 'id' dato que viene de la vista
        $tipoCosto->estado = '1';
        $tipoCosto->save();
    }
}
