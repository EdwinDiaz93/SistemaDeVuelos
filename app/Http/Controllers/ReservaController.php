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
          $vuelos=Vuelo::with("aerolinea","clasevuelo","aeropuertoida","aeropuertoreg","horarioida","horarioreg","precio")->get();
          $reservas=Reserva::with("cliente","vuelo")->paginate(3);
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
        $reserva = new Reserva();        
        $reserva->estado = '0';
        $reserva->cliente_id=$request->cliente_id;
        $reserva->vuelo_id=$request->vuelo_id;
        $reserva->save();
    }

  
     
    public function pay(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');

        $reserva = Reserva::findOrFail($request->idreserva);
        $reserva->pago()->create([
            'numerotarjeta'=>$request->numerotarjeta,
            'codigoseguridad'=>$request->codigoseguridad,
            'fechavencimiento'=>$request->fechavencimiento,
        ]);        
        $pago=Pago::latest()->first();
        $reserva->pago_id=$pago->idpago;
        $reserva->estado = '1'; 
        $reserva->save();
    }
    
   
}
