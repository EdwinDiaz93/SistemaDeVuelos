<?php

namespace App\Http\Controllers;

use App\Models\AeroLinea;
use App\Models\Aeropuerto;
use App\Models\Pais;
use App\Models\Cuidad;
use Illuminate\Http\Request;

class AeropuertoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aeropuertos=Aeropuerto::all();
        return view('aeropuerto.index')->with('aeropuertos',$aeropuertos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('aeropuerto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aeropuertos = new Aeropuerto();
        $aeropuertos->codAeropuerto =$request->get('codAeropuerto');
        $aeropuertos->nomAeropuerto =$request->get('nomAeropuerto');
        $aeropuertos->nomResponsable =$request->get('nomResponsable');
        $aeropuertos->telefono =$request->get('telefono');
        $aeropuertos->numBahias =$request->get('numBahias');
        $aeropuertos ->save();

        return redirect('/aeropuerto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codAeropuerto)
    {

        $aeropuerto=Aeropuerto::find($codAeropuerto);
        return view('aeropuerto.edit')->with('aeropuerto',$aeropuerto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codAeropuerto)
    {
        $aeropuerto = Aeropuerto::find($codAeropuerto);
        $aeropuerto->codAeropuerto =$request->get('codAeropuerto');
        $aeropuerto->nomAeropuerto =$request->get('nomAeropuerto');
        $aeropuerto->nomResponsable =$request->get('nomResponsable');
        $aeropuerto->telefono =$request->get('telefono');
        $aeropuerto->numBahias =$request->get('numBahias');
        $aeropuerto ->save();

        return redirect('/aeropuerto');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($codAeropuerto)
    {
        $aeropuerto = Aeropuerto::find($codAeropuerto);
        $aeropuerto ->delete();
        return redirect('/aeropuerto');
    }
}
