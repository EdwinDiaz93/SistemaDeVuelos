<?php

namespace App\Http\Controllers;
use App\Models\TipoDocumento;

use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{

    public function index(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/main');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $tipoDocumentos = TipoDocumento::orderBy('idtipodocumento', 'desc')->paginate(3);
        }
        else{
            $tipoDocumentos = TipoDocumento::where($criterio, 'like', '%'. $buscar . '%')->orderBy('idtipodocumento', 'desc')->paginate(3);        
        }
        
        return [

            'pagination' => [

                'total'        =>  $tipoDocumentos->total(),
                'current_page' =>  $tipoDocumentos->currentPage(),
                'per_page'     =>  $tipoDocumentos->perPage(),
                'last_page'    =>  $tipoDocumentos->lastPage(),
                'from'         =>  $tipoDocumentos->firstItem(),
                'to'           =>  $tipoDocumentos->lastItem(),
            ],
            'tipoDocumentos' => $tipoDocumentos 
        ];
       
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
    public function selectTipoDocumento(Request $request){
        if(!$request->ajax()) return redirect('/main');
        $tipoDocumentos = TipoDocumento::where('estado','=','1')    //selecciona solo los roles activos
        ->select('idtipodocumento','nomdocumento')->orderBy('nomdocumento', 'asc')->get();
        return ['tipoDocumentos' => $tipoDocumentos];
    }


    public function store(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/main');
        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->nomdocumento = $request->nombre; // 'nombre' es lo que recibimos de la vista
        $tipoDocumento->numerodocumento = $request->numero; 
        $tipoDocumento->estado = '1';
        $tipoDocumento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/main');
        $tipoDocumento = TipoDocumento::findOrFail($request->tipoDocumento_id);
        $tipoDocumento->nomdocumento = $request->nombre;
        $tipoDocumento->numerodocumento = $request->numero;
        $tipoDocumento->estado = '1';
        $tipoDocumento->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDocumento $tipoDocumento)
    {
        //
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/main');
        $tipoDocumento = TipoDocumento::findOrFail($request->id); // 'id' dato que viene de la vista
        $tipoDocumento->estado = '0';
        $tipoDocumento->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipoDocumento = TipoDocumento::findOrFail($request->id);  // 'id' dato que viene de la vista
        $tipoDocumento->estado = '1';
        $tipoDocumento->save();
    }
}
