<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = User::join('personas','users.idpersona','=','personas.idpersona')
            ->join('rol','users.idrol','=','rol.idrol')
            ->select('personas.idpersona','personas.pnombre','personas.snombre',
            'personas.papellido','personas.sapellido','personas.dui','personas.nit',
            'personas.pasaporte','personas.fechanaci','personas.direccion',
            'personas.telefono','personas.movil','users.nomusuario','users.email','users.password',
            'users.estado','users.idrol','rol.nomrol as rol')
            ->orderBy('personas.idpersona', 'desc')->paginate(3);
        }
        else{
            $personas = User::join('personas','users.idpersona','=','personas.idpersona')
            ->join('rol','users.idrol','=','rol.idrol')
            ->select('personas.idpersona','personas.pnombre','personas.snombre',
            'personas.papellido','personas.sapellido','personas.dui','personas.nit',
            'personas.pasaporte','personas.fechanaci','personas.direccion',
            'personas.telefono','personas.movil','users.nomusuario','users.email','users.password',
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

    /*public function logueo(Request $request){

        //Saber rol de usuario
        $usuario = $request->user();

        error_log($usuario);
        $rol = Rol::where('idrol', '=', $usuario->idrol)->get();
        error_log($rol);

        return view('contenido/contenido', ['rol'=>$rol[0]->nomrol]);
    }*/

   
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