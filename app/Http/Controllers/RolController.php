<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $roles = Rol::orderBy('idrol', 'desc')->paginate(5);
        }
        else{
            $roles = Rol::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idrol', 'desc')->paginate(5);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $roles->total(),
                'current_page' =>  $roles->currentPage(),
                'per_page'     =>  $roles->perPage(),
                'last_page'    =>  $roles->lastPage(),
                'from'         =>  $roles->firstItem(),
                'to'           =>  $roles->lastItem(),
            ],
            'roles' => $roles 
        ];
       
    }

    public function selectRol(Request $request){
        if(!$request->ajax()) return redirect('/main');
        $roles = Rol::where('estado','=','1')    //selecciona solo los roles activos
        ->select('idrol','nomrol')->orderBy('nomrol', 'asc')->get();
        return ['roles' => $roles];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $rol = new Rol();
        $rol->nomrol = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->estado = '1';
        $rol->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $rol = Rol::findOrFail($request->rol_id);
        $rol->nomrol = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->estado = '1';
        $rol->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $rol = Rol::findOrFail($request->id);
        $rol->estado = '0';
        $rol->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $rol = Rol::findOrFail($request->id);
        $rol->estado = '1';
        $rol->save();
    }
    
}
