<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $horarios = Horario::orderBy('idhorario', 'desc')->paginate(3);
        }
        else{
            $horarios = Horario::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idhorario', 'desc')->paginate(3);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $horarios->total(),
                'current_page' =>  $horarios->currentPage(),
                'per_page'     =>  $horarios->perPage(),
                'last_page'    =>  $horarios->lastPage(),
                'from'         =>  $horarios->firstItem(),
                'to'           =>  $horarios->lastItem(),
            ],
            'horarios' => $horarios 
        ];
    }

    public function selectHorario(Request $request){
        if(!$request->ajax()) return redirect('/');
        $horarios = Horario::where('estado','=','1')    //selecciona solo los roles activos
        ->select('idhorario','fecha','hora')->orderBy('fecha', 'asc')->get();
        return ['horarios' => $horarios];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $horario = new Horario();
        $horario->fecha = $request->fecha;
        $horario->hora = $request->hora;
        $horario->estado = '1';
        $horario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->horario_id);
        $horario->fecha = $request->fecha;
        $horario->hora = $request->hora;
        $horario->estado = '1';
        $horario->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->estado = '0';
        $horario->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->estado = '1';
        $horario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
