<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\User;

class EmpleadoController extends Controller
{
    //
    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $empleados = Empleado::join('personas','personas.idpersona','=','empleados.idpersona')
            ->join('users','users.idpersona','=','personas.idpersona')
            ->join('rol','rol.idrol','=','users.idrol')
            ->select('personas.pnombre','personas.snombre','personas.papellido','personas.sapellido','personas.dui','personas.nit',
                     'personas.pasaporte','personas.fechanaci','personas.direccion', 'personas.telefono', 'personas.movil',
                     'empleados.puesto','empleados.salario','empleados.condicion', 
                     'rol.nomrol as nombre_rol',
                     'users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->orderBy('personas.idpersona', 'desc')->paginate(3);
        }
        

        else{
            $empleados = Empleado::join('personas','personas.idpersona','=','empleados.idpersona')
            ->join('users','users.idpersona','=','personas.idpersona')
            ->join('rol','rol.idrol','=','users.idrol')
            ->select('personas.pnombre','personas.snombre','personas.papellido','personas.sapellido','personas.dui','personas.nit',
                     'personas.pasaporte','personas.fechanaci','personas.direccion', 'personas.telefono', 'personas.movil',
                     'empleados.puesto','empleados.salario','empleados.condicion', 
                     'rol.nomrol as nombre_rol',
                     'users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('personas.idpersona', 'desc')->paginate(3);
        }
        
        return [

            'pagination' => [

                'total'        =>  $empleados->total(),
                'current_page' =>  $empleados->currentPage(),
                'per_page'     =>  $empleados->perPage(),
                'last_page'    =>  $empleados->lastPage(),
                'from'         =>  $empleados->firstItem(),
                'to'           =>  $empleados->lastItem(),
            ],
            'empleados' => $empleados 
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

            $empleado = new Empleado();
            $empleado->idpersona = $persona->idpersona;
            $empleado->puesto = $request->puesto;
            $empleado->salario = $request->salario;
            $empleado->condicion = '1';
            $empleado->save();

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

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el empleado a modificar
            $empleado = Empleado::findOrFail($request->idempleado);

            $persona = Persona::findOrFail($proveedor->idpersona);

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

            
            $empleado->idpersona = $persona->idpersona;
            $empleado->puesto = $request->puesto;
            $empleado->salario = $request->salario;
            $empleado->condicion = '1';
            $empleado->save();
           
            $user->idpersona = $persona->idpersona;
            $user->nomusuario = $request->nomusuario;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->estado = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $empleado = Empleado::findOrFail($request->idempleado);
        $empleado->estado = '0';
        $empleado->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $empleado = Empleado::findOrFail($request->idempleado);
        $empleado->estado = '1';
        $empleado->save();
    }

}
