@extends('layout')

@section('content')
    <h2>Redes Sociales</h2>

    <a class="btn btn-success my-3" href="{{route("red.create")}}">Crear Red Social</a>
    <table class="table">
        <thead>
            <tr>                     
                <th>Nombre Red</th>
                <th>Acciones</th>
            </tr>
        </thead>
        @forelse ($redes as $redsocial)
          <tbody>
            <tr>                          
              <td>{{$redsocial->NombreRedSocial}}</td>   
              <td>
                <a class="btn btn-warning text-white " href="{{route("red.edit",["redsocial"=>$redsocial->idRedSocial])}}">Editar</a>
                <form class="d-inline-block" action="{{route("red.destroy",["redsocial"=>$redsocial->idRedSocial])}}" method="POST">
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger btn">Eliminar</button>
                  @csrf
                </form>
              </td>           
            </tr>          
          </tbody>    
        @empty
            <h1>No hay redes disponibles</h1>
        @endforelse
        
      </table>
@endsection