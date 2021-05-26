<?php

namespace App\Http\Controllers;

use App\Models\RedSocial;
use Illuminate\Http\Request;

class RedSocialController extends Controller
{
    
    public function index()
    {
       $redes=RedSocial::all(); 
       return view("redsocial.index",compact("redes"));
    }

   
    public function create()
    {
        $redsocial= new RedSocial();
        return view("redsocial.create",compact("redsocial"));
    }

    
    public function store(Request $request)
    {
        $data=$request->validate([
            'NombreRedSocial' => 'required|min:3',            
        ],);     

        RedSocial::create($data);
        return redirect("redsocial");
    }

      
   
    public function edit(RedSocial $redsocial)
    {        
        return view("redsocial.edit",compact("redsocial"));
    }

    
    public function update(Request $request, RedSocial $redsocial)
    {
        $data=$request->validate([
            'NombreRedSocial' => 'required|min:3',            
        ],);           
        $redsocial->update($data);

        return redirect("redsocial");
    }

   
    public function destroy(RedSocial $redsocial)
    {        
        $redsocial->delete();
        return redirect("redsocial");
    }

  
}
