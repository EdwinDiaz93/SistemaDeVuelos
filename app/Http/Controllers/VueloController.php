<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelo;
use App\Models\AeroLinea;
use App\Models\Horario;
use App\Models\Aeropuerto;
use App\Models\Precio;
use App\Models\ClaseVuelo;
use App\Models\Ciudad;


class VueloController extends Controller
{
    
    public function index(Request $request)
    {
          //  if(!$request->ajax()) return redirect('/main');
          $buscar = $request->buscar;
          $criterio = $request->criterio;
  
        if($buscar==''){          
            $vuelos=Vuelo::with("aerolinea","aeropuertoida","aeropuertoreg")->orderBy('idvuelo', 'desc')->paginate(3);
            $aerolineas=AeroLinea::orderBy('codaerolinea', 'desc')->paginate(3);
            $horarios=Horario::orderBy('idhorario', 'desc')->paginate(3);
            $aeropuertos=Aeropuerto::orderBy('codaeropuerto', 'desc')->paginate(3);
            $precios=Precio::orderBy('idprecio', 'desc')->paginate(3);
            $clasevuelos=ClaseVuelo::orderBy('idclasevuelo', 'desc')->paginate(3);
            $ciudades=Ciudad::with("pais")->orderBy('idciudad', 'desc')->paginate(10);
        }
        else{          
            $vuelos = Vuelo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idvuelo', 'desc')->paginate(3);          
        }
        
        return [
  
            'pagination' => [
  
                'total'        =>  $vuelos->total(),
                'current_page' =>  $vuelos->currentPage(),
                'per_page'     =>  $vuelos->perPage(),
                'last_page'    =>  $vuelos->lastPage(),
                'from'         =>  $vuelos->firstItem(),
                'to'           =>  $vuelos->lastItem(),
            ],
            'vuelos'=>$vuelos,            
            'aerolineas'=>$aerolineas,            
            'horarios'=>$horarios,            
            'aeropuertos'=>$aeropuertos,            
            'precios'=>$precios,            
            'clasevuelos'=>$clasevuelos,            
            'ciudades'=>$ciudades,            
        ];
    }

  
    public function store(Request $request)
    {           
        if(!$request->ajax()) return redirect('/main');
        $vuelo = new Vuelo();
        $vuelo->aerolinea_cod = $request->aerolinea_cod; 
        $vuelo->idprecio = $request->idprecio;         
        $vuelo->idhorariosalida = $request->idhorariosalida;         
        $vuelo->idhorarioregreso = $request->idhorarioregreso;         
        $vuelo->idaeropuertoida= $request->idaeropuertoida;
        $vuelo->idaeropuertoregreso= $request->idaeropuertoregreso;
        $vuelo->idciudadorigen= $request->idciudadorigen;
        $vuelo->idciudaddestino= $request->idciudaddestino;
        $vuelo->idclasevuelo= $request->idclasevuelo;
        $vuelo->millasreales = $request->millasreales;         
        $vuelo->millasotorgadas = $request->millasotorgadas;         
        $vuelo->estado = '1';         
        $vuelo->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $vuelo = Vuelo::findOrFail($request->idvuelo);        
        $vuelo->aerolinea_cod = $request->aerolinea_cod; 
        $vuelo->idprecio = $request->idprecio;         
        $vuelo->idhorariosalida = $request->idhorariosalida;         
        $vuelo->idhorarioregreso = $request->idhorarioregreso;         
        $vuelo->idaeropuertoida= $request->idaeropuertoida;
        $vuelo->idaeropuertoregreso= $request->idaeropuertoregreso;
        $vuelo->idciudadorigen= $request->idciudadorigen;
        $vuelo->idciudaddestino= $request->idciudaddestino;
        $vuelo->idclasevuelo= $request->idclasevuelo;
        $vuelo->millasreales = $request->millasreales;         
        $vuelo->millasotorgadas = $request->millasotorgadas;         
        $vuelo->estado = '1';         
        $vuelo->save();
    }

    public function desactivar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $vuelo = Vuelo::findOrFail($request->id); // 'id' dato que viene de la vista
        $vuelo->estado = '0';
        $vuelo->save();
    }

    public function activar(Request $request)
    {        
        if(!$request->ajax()) return redirect('/main');
        $vuelo = Vuelo::findOrFail($request->id); // 'id' dato que viene de la vista
        $vuelo->estado = '1';
        $vuelo->save();
    }
}
