@extends('layout')

@section('content')
    <h2>Tipo Avion</h2>

    <a class="btn btn-success my-3" href="{{route("tipoavion.create")}}">Crear Tipo Avion</a>
    <table class="table">
        <thead>
            <tr>                     
                <th>Nombre De Tipo de avion</th>
                <th>Cantidad De Asientos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        @forelse ($tipoaviones as $tipoavion)
          <tbody>
            <tr>                          
              <td>{{$tipoavion->nombretipoavion}}</td>   
              <td>{{$tipoavion->cantidadasientos}}</td>   
              <td>
                <a class="btn btn-warning text-white " href="{{route("tipoavion.edit",["tipoavion"=>$tipoavion->idtipoavion])}}"><i class="far fa-edit"></i></a>
                <form class="d-inline-block" action="{{route("tipoavion.destroy",["tipoavion"=>$tipoavion->idtipoavion])}}" method="POST">
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger btn"><i class="fas fa-trash-alt"></i></button>
                  @csrf
                </form>
              </td>           
            </tr>          
          </tbody>    
        @empty
            <h1>No hay tipos de avion disponibles</h1>
        @endforelse
        
      </table>
@endsection