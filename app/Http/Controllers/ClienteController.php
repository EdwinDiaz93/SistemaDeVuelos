<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\User;



class ClienteController extends Controller
{

    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $clientes = Cliente::join('personas','personas.idpersona','=','clientes.idpersona')
            ->join('users','users.idpersona','=','personas.idpersona')
            ->join('rol','rol.idrol','=','users.idrol')
            ->select('personas.pnombre','personas.snombre','personas.papellido','personas.sapellido','personas.dui','personas.nit',
                     'personas.pasaporte','personas.fechanaci','personas.direccion', 'personas.telefono', 'personas.movil',
                     'clientes.estadocivil','clientes.genero','clientes.nomcontacto','clientes.numfrecuente', 
                     'rol.nomrol as nombre_rol',
                     'users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->orderBy('personas.idpersona', 'desc')->paginate(3);
        }
        

        else{
            $personas = Cliente::join('personas','personas.idpersona','=','clientes.idpersona')
            ->join('users','users.idpersona','=','personas.idpersona')
            ->join('rol','rol.idrol','=','users.idrol')
            ->select('personas.pnombre','personas.snombre','personas.papellido','personas.sapellido','personas.dui','personas.nit',
                     'personas.pasaporte','personas.fechanaci','personas.direccion', 'personas.telefono', 'personas.movil',
                     'clientes.estadocivil','clientes.genero','clientes.nomcontacto','clientes.numfrecuente', 
                     'rol.nomrol as nombre_rol',
                     'users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('personas.idpersona', 'desc')->paginate(3);
        }
        
        return [

            'pagination' => [

                'total'        =>  $clientes->total(),
                'current_page' =>  $clientes->currentPage(),
                'per_page'     =>  $clientes->perPage(),
                'last_page'    =>  $clientes->lastPage(),
                'from'         =>  $clientes->firstItem(),
                'to'           =>  $clientes->lastItem(),
            ],
            'clientes' => $clientes 
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        try
        {
            $persona = new Persona();
            $persona->pnombre = $request->pnombre;
            $persona->snombre = $request->snombre;
            $persona->papellido = $request->papellido;
            $persona->sapellido = $request->sapellido;
            $persona->fechanaci = $request->fechanaci;
            $persona->direccion = $request->direccion;
            $persona->dui = $request->dui;
            $persona->nit = $request->nit;
            $persona->pasaporte = $request->pasaporte;
            $persona->telefono = $request->telefono;
            $persona->movil = $request->movil;
            $persona->save();

            $cliente = new Cliente();
            $cliente->idpersona = $persona->idpersona;
            $cliente->estadocivil = $request->estadocivil;
            $cliente->genero = $request->genero;
            $cliente->nomcontacto = $request->nomcontacto;
            $cliente->numfrecuente = $request->numfrecuente;
            $cliente->save();

            $user = new User();
            $user->idpersona = $persona->idpersona;
            $user->nomusuario = $request->nomusuario;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->estado = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();

        }
        
        catch(Exception $e){
            DB::rollBack();
        }
    }

   
    
}
