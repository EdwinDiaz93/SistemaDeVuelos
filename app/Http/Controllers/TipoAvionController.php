<?php

namespace App\Http\Controllers;

use App\Models\TipoAvion;
use Illuminate\Http\Request;

class TipoAvionController extends Controller
{

    public function index()
    {
        $tipoaviones=TipoAvion::all();
        return view("tipoavion.index",compact("tipoaviones"));
    }

    
    public function create()
    {
        $tipoavion=new TipoAvion();
        return view("tipoavion.create",compact("tipoavion"));
    }

    
    public function store(Request $request)
    {
        $data=$request->validate([
            'NombreTipoAvion' => 'required|min:3',
            'CantidadAsientos' => 'required|numeric',                     
        ],);    

        TipoAvion::create($data);
        return redirect("tipoavion");
    }

    
  

    
    public function edit(TipoAvion $tipoavion)
    {
        return view("tipoavion.edit",compact("tipoavion"));
    }

    
    public function update(Request $request, TipoAvion $tipoavion)
    {
        $data=$request->validate([
            'NombreTipoAvion' => 'required|min:3',
            'CantidadAsientos' => 'required|numeric',                     
        ],);   

        $tipoavion->update($data);
        return redirect("tipoavion");
    }

    
    public function destroy(TipoAvion $tipoavion)
    {
        $tipoavion->delete();
        return redirect("tipoavion");
    }
}
