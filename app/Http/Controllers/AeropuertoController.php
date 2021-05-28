<?php

namespace App\Http\Controllers;


use App\Models\Aeropuerto;
use App\Models\Pais;
use App\Models\Cuidad;
use Illuminate\Http\Request;

class AeropuertoController extends Controller
{
      
    public function index()
    {
        $aeropuertos=Aeropuerto::all();
        return view("aeropuerto.index",compact("aeropuertos"));
    }

  
    public function create()
    {
        $aeropuerto=new Aeropuerto();
        $pais=Pais::all();
        $cuidad=Cuidad::all();
        $vars=["aeropuerto"=>$aeropuerto,"pais"=>$pais, "cuidad"=>$cuidad];
        return view("aeropuerto.create",compact("vars"));
    }

        //falta el ajax para habilitar los paises y sus respectivas cuidades
        
   
    public function store(Request $request)
    {
        $data=$request->validate([
            'codAeropuerto' => 'required|min:3',
            'nomAeropuerto' => 'required|min:3',
            'nomResponsable' => 'required|min:3',
            'pais_id' => 'required', 
            'cuidad_id' => 'required',   
            'telefono' => 'required|min:3',
            'numBahias' => 'required|numeric',                  
        ],);   
        Aeropuerto::create($data);
        return redirect("aeropuerto");
    }

    
    public function show(Aeropuerto $aeropuerto)
    {
        $pais=Pais::all();
        $cuidad=Cuidad::all();
        $vars=["aeropuerto"=>$aeropuerto,"pais"=>$pais,"cuidad"=>$cuidad];
        return view("aeropuerto.show",compact("vars"));
    }

   
    public function edit(Aeropuerto $aeropuerto)
    {
        $pais=Pais::all();
        $cuidad=Cuidad::all();
        $vars=["aeropuerto"=>$aeropuerto,"pais"=>$pais,"cuidad"=>$cuidad];
        return view("aeropuerto.edit",compact("vars"));
    }

   
    public function update(Request $request, Aeropuerto $aeropuerto)
    {
        $data=$request->validate([
            'codAeropuerto' => 'required|min:3',
            'nomAeropuerto' => 'required|min:3',
            'nomResponsable' => 'required|min:3',
            'pais_id' => 'required', 
            'cuidad_id' => 'required',   
            'telefono' => 'required|min:3',
            'numBahias' => 'required|numeric',                    
        ],);   

        $aeropuerto->update($data);
        return redirect("aeropuerto");
    }

   
    public function destroy(Aeropuerto $aeropuerto)
    {        
        $aeropuerto->delete();
        return redirect("aeropuerto");
    }
}
