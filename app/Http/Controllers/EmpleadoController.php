<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Empleado;
use App\Models\Persona;


class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Empleado::join('persona','empleado.idpersona','=','persona.idpersona')
            ->select('persona.idpersona','persona.pnombre','persona.snombre',
            'persona.papellido','persona.sapellido','persona.fechanaci','persona.direccion',
            'persona.telefono','persona.movil','empleado.puesto','empleado.salario','empleado.estado')
            ->orderBy('persona.idpersona', 'desc')->paginate(3);
        }
        else{
            $personas = Empleado::join('persona','empleado.idpersona','=','persona.idpersona')
            ->select('persona.idpersona','persona.pnombre','persona.snombre',
            'persona.papellido','persona.sapellido','persona.fechanaci','persona.direccion',
            'persona.telefono','persona.movil','empleado.puesto','empleado.salario','empleado.estado')            
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

            $empleado = new Empleado();
            $empleado->puesto = $request->puesto;
            $empleado->salario = $request->salario;
            $persona->estado = '1';
            $empleado->idpersona = $persona->idpersona;
            $empleado->save();

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

            //Buscar primero el empleado a modificar
            $empleado = Empleado::findOrFail($request->idpersona);

            $persona = Persona::findOrFail($proveedor->idpersona);

            $persona->pnombre = $request->pnombre;
            $persona->snombre = $request->snombre;
            $persona->papellido = $request->papellido;
            $persona->sapellido = $request->sapellido;
            $persona->fechanaci = $request->fechanaci;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->movil = $request->movil;
            $persona->save();

            
            $empleado->puesto = $request->puesto;
            $empleado->salario = $request->salario;
            $persona->estado = '1';
            $empleado->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
    
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->idpersona);
        $empleado->estado = '0';
        $empleado->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->idpersona);
        $empleado->estado = '1';
        $empleado->save();
    }

}

