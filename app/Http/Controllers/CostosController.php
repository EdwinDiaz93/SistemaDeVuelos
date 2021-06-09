<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costos;

class CostosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $costos = Costos::join('tipo_costo','costos.idtipocosto','=','tipo_costo.idtipocosto')
            ->select('costos.idcosto','costos.idtipocosto','costos.cantidad','costos.descripcion','tipo_costo.nomtipocosto as nombre_tipocosto','costos.estado')
            ->orderBy('costos.idcosto', 'desc')->paginate(3);
        }
        elseif($criterio=='nomtipocosto'){
            $costos = Costos::join('tipo_costo','costos.idtipocosto','=','tipo_costo.idtipocosto')
            ->select('costos.idcosto','costos.idtipocosto','costos.cantidad','costos.descripcion','tipo_costo.nomtipocosto as nombre_tipocosto','costos.estado')
            ->where('tipo_costo.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('costos.idcosto', 'desc')->paginate(3);
        }

        else{
             $costos = Costos::join('tipo_costo','costos.idtipocosto','=','tipo_costo.idtipocosto')
            ->select('costos.idcosto','costos.idtipocosto','costos.cantidad','costos.descripcion','tipo_costo.nomtipocosto as nombre_tipocosto','costos.estado')
            ->where('costos.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('costos.idcosto', 'desc')->paginate(3);
        }
        
        return [

            'pagination' => [

                'total'        =>  $costos->total(),
                'current_page' =>  $costos->currentPage(),
                'per_page'     =>  $costos->perPage(),
                'last_page'    =>  $costos->lastPage(),
                'from'         =>  $costos->firstItem(),
                'to'           =>  $costos->lastItem(),
            ],
            'costos' => $costos 
        ];
       
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $costo = new Costos();
        $costo->idtipocosto = $request->idtipocosto;
        $costo->cantidad = $request->cantidad;
        $costo->descripcion = $request->descripcion;
        $costo->estado = '1';
        $costo->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $costo = Costos::findOrFail($request->id);
        $costo->idtipocosto = $request->idtipocosto;
        $costo->cantidad = $request->cantidad;
        $costo->descripcion = $request->descripcion;
        $costo->estado = '1';
        $costo->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $costo = Costos::findOrFail($request->id);
        $costo->estado = '0';
        $costo->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $costo = Costos::findOrFail($request->id);
        $costo->estado = '1';
        $costo->save();
    }
}
