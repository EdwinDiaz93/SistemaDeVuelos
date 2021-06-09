<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = User::join('persona','users.idpersona','=','persona.idpersona')
            ->join('rol','users.idrol','=','rol.idrol')
            ->select('persona.idpersona','persona.pnombre','persona.snombre',
            'persona.papellido','persona.sapellido','persona.fechanaci','persona.direccion',
            'persona.telefono','persona.movil','users.usuario','users.email','users.password',
            'users.estado','users.idrol','rol.nomrol as rol')
            ->orderBy('persona.idpersona', 'desc')->paginate(3);
        }
        else{
            $personas = User::join('persona','users.idpersona','=','persona.idpersona')
            ->join('rol','users.idrol','=','rol.idrol')
            ->select('persona.idpersona','persona.pnombre','persona.snombre',
            'persona.papellido','persona.sapellido','persona.fechanaci','persona.direccion',
            'persona.telefono','persona.movil','users.usuario','users.email','users.password',
            'users.estado','users.idrol','rol.nomrol as rol')            
            ->where('persona.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('persona.idpersona', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->pnombre = $request->pnombre;
            $persona->snombre = $request->snombre;
            $persona->papellido = $request->papellido;
            $persona->sapellido = $request->sapellido;
            $persona->fechanaci = $request->fechanaci;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->movil = $request->movil;
            $persona->save();

            $user = new User();
            $user->usuario = $request->usuario;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->estado = '1';          
            $user->idrol = $request->idrol;

            $user->idpersona = $persona->idpersona;

            $user->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $user = User::findOrFail($request->idpersona);

            $persona = Persona::findOrFail($user->idpersona);

            $persona->pnombre = $request->pnombre;
            $persona->snombre = $request->snombre;
            $persona->papellido = $request->papellido;
            $persona->sapellido = $request->sapellido;
            $persona->fechanaci = $request->fechanaci;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->movil = $request->movil;
            $persona->save();

            
            $user->usuario = $request->usuario;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
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
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->idpersona);
        $user->estado = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->idpersona);
        $user->estado = '1';
        $user->save();
    }


}