<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Models\TipoAvion;
use Illuminate\Http\Request;

class AvionController extends Controller
{
    
     
    public function index()
    {
        $aviones=Avion::all();
        return view("avion.index",compact("aviones"));
    }

  
    public function create()
    {
        $avion=new Avion();
        $tiposAvion=TipoAvion::all();
        $vars=["avion"=>$avion,"tiposAvion"=>$tiposAvion];
        return view("avion.create",compact("vars"));
    }

   
    public function store(Request $request)
    {
        $data=$request->validate([
            'ModeloAvion' => 'required|min:3',
            'MarcaAvion' => 'required|min:3',
            'tipoavion_id' => 'required',                     
        ],);   
        Avion::create($data);
        return redirect("aviones");
    }

    
    public function show(Avion $avione)
    {
        $tiposAvion=TipoAvion::all();
        $vars=["avion"=>$avione,"tiposAvion"=>$tiposAvion];
        return view("avion.show",compact("vars"));
    }

   
    public function edit(Avion $avione)
    {
        $tiposAvion=TipoAvion::all();
        $vars=["avion"=>$avione,"tiposAvion"=>$tiposAvion];
        return view("avion.edit",compact("vars"));
    }

   
    public function update(Request $request, Avion $avione)
    {
        $data=$request->validate([
            'ModeloAvion' => 'required|min:3',
            'MarcaAvion' => 'required|min:3',
            'tipoavion_id' => 'required',                     
        ],);   

        $avione->update($data);
        return redirect("aviones");
    }

   
    public function destroy(Avion $avione)
    {        
        $avione->delete();
        return redirect("aviones");
    }
}
