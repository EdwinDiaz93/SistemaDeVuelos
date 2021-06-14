<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Pago;
use App\Models\Vuelo;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        //  if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

      if($buscar==''){
          $clientes = Cliente::orderBy('idcliente', 'desc')->paginate(3);
          $vuelos=Vuelo::all();
          $reservas=Reserva::where("estado","=","1")->orderBy('idreserva', 'desc')->paginate(3);
      }
      else{          
          $reservas = Reserva::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idreserva', 'desc')->paginate(3);          
      }
      
      return [

          'pagination' => [

              'total'        =>  $reservas->total(),
              'current_page' =>  $reservas->currentPage(),
              'per_page'     =>  $reservas->perPage(),
              'last_page'    =>  $reservas->lastPage(),
              'from'         =>  $reservas->firstItem(),
              'to'           =>  $reservas->lastItem(),
          ],
          'clientes'=>$clientes,
          'vuelos' => $vuelos,
          'reservas' => $reservas,
      ];
    }

     
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $cliente =  Cliente::find($request->cliente_id);;
        $vuelo =  Vuelo::find($request->vuelo_id);
        $reserva = new Reserva();        
        $reserva->estado = '0';
        $reserva->cliente()->save($cliente);
        $reserva->vuelo()->save($vuelo);        
        $reserva->save();
    }

  
     
    public function pay(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');

        $reserva = Reserva::findOrFail($request->idreserva);
        $pago=Pago::create([
            'numerotarjeta'=>$request->numerotarjeta,
            'codigoseguridad'=>$request->codigoseguridad,
            'fechavencimiento'=>$request->fechavencimiento,
        ]);
        // $reserva->pago()->save($pago);
        $pago->reserva()->associate($reserva)->save();
        $reserva->estado = '1'; 
        
        $reserva->save();
    }
    
   
}
