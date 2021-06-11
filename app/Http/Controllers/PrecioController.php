<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Precio;
class PrecioController extends Controller
{
    
    public function index(Request $request)
    {
      //if(!$request->ajax()) return redirect('/');
      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if($buscar==''){
          $precios = Precio::orderBy('idprecio', 'desc')->paginate(3);
      }
      else{
          $precios = Precio::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idprecio', 'desc')->paginate(3);        
      }
      
      return [

          'pagination' => [

              'total'        =>  $precios->total(),
              'current_page' =>  $precios->currentPage(),
              'per_page'     =>  $precios->perPage(),
              'last_page'    =>  $precios->lastPage(),
              'from'         =>  $precios->firstItem(),
              'to'           =>  $precios->lastItem(),
          ],
          'precios' => $precios 
      ];
    }

    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $precio = new Precio();
        $precio->cantidadprecio = $request->cantidadprecio; // 'nombre' es lo que recibimos de la vista        
        $precio->estado = '1';
        $precio->save();
    }

    
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $precio = Precio::findOrFail($request->precio_id);        
        $precio->cantidadprecio = $request->cantidadprecio; // 'cantidad' es lo que recibimos de la vista
        $precio->estado = '1';
        $precio->save();
    }

    
    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $precio = Precio::findOrFail($request->id); // 'id' dato que viene de la vista
        $precio->estado = '0';
        $precio->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $precio = Precio::findOrFail($request->id); // 'id' dato que viene de la vista
        $precio->estado = '1';
        $precio->save();
    }
}
