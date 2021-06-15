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
        //if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $usuarios = User::join('rol','rol.idrol','=','users.idrol')
            ->select('rol.idrol','rol.nomrol as nombre_rol',
                     'users.idusuario','users.idpersona','users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->orderBy('users.idusuario', 'desc')->paginate(3);
        }

        elseif($criterio=='nomrol'){
            $usuarios = User::join('rol','rol.idrol','=','users.idrol')
            ->select('rol.idrol','rol.nomrol as nombre_rol',
                     'users.idusuario', 'users.idpersona','users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->where('rol.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('rol.idrol', 'desc')->paginate(3);
        }
        

        else{
            $usuarios = User::join('rol','rol.idrol','=','users.idrol')
            ->select('rol.idrol','rol.nomrol as nombre_rol',
                     'users.idusuario', 'users.idpersona','users.nomusuario', 'users.password', 'users.email', 'users.estado')
            ->where('users.'.$criterio, 'like', '%'. $buscar . '%' )
            ->orderBy('users.idusuario', 'desc')->paginate(3);
        }
        
        return [

            'pagination' => [

                'total'        =>  $usuarios->total(),
                'current_page' =>  $usuarios->currentPage(),
                'per_page'     =>  $usuarios->perPage(),
                'last_page'    =>  $usuarios->lastPage(),
                'from'         =>  $usuarios->firstItem(),
                'to'           =>  $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios 
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

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
    
            $user = User::findOrFail($request->idusuario);
            
            $user->idpersona = $request->idpersona;
            $user->nomusuario = $request->nomusuario;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->estado = '1';
            $user->idrol = $request->idrol;
            $user->save();
    }
   
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->estado = '1';
        $user->save();
    }


}