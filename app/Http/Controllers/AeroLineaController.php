<?php

namespace App\Http\Controllers;

use App\Models\AeroLinea;
use App\Models\RedSocial;
use Illuminate\Http\Request;

class AeroLineaController extends Controller
{
   
    public function index()
    {
        $aerolineas=AeroLinea::all();
        return view("aerolinea.index", compact("aerolineas"));
    }

   
    public function create()
    {
        $aerolinea= new AeroLinea();
        $redes=RedSocial::all();
        $vars=["aerolinea"=>$aerolinea,"redes"=>$redes];
        return view("aerolinea.create",compact("vars"));
    }

   
    public function store(Request $request)
    {           
        $data=$request->validate([
            'codAeroLinea' => 'required|min:3',
            'NombreAeroLinea' => 'required|min:3',
            'NombreOficial' => 'required|min:3',
            'NombreCorto' => 'required|min:3',
            'NombreRepresentante' => 'required|min:3',
            'FechaFundacion' => 'required|date',            
        ],);     

        $aeroLineaCreada=AeroLinea::create($data);        

        foreach ($request->get('urls') as $index=>$url ) {     
            $aeroLineaCreada->redes()->attach([$index=>["url"=>$url]]);
        }
            return redirect("aerolineas");
    }

   
    public function show(AeroLinea $aerolinea)
    {
        //
    }

    
    public function edit(AeroLinea $aerolinea)
    {
        //
    }

    public function update(Request $request, AeroLinea $aerolinea)
    {
        //
    }

    
    public function destroy(AeroLinea $aerolinea)
    {
        //
    }
}
