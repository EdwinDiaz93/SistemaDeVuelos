@extends('principal')
@section('contenido')


        @if(Auth::check())
                @if(Auth::user()->idrol == 1)
                

    <template v-if="menu==1">
        <clasevuelo></clasevuelo>
    </template>

    <template v-if="menu==2">
        <horario></horario>
    </template>

    <template v-if="menu==3">
        <costos></costos>
    </template>

    <template v-if="menu==4">
        <tipocosto></tipocosto>
    </template>

    <template v-if="menu==5">
        <tipodocumento></tipodocumento>
    </template>

    <template v-if="menu==6">
    <user></user>
    </template>

    <template v-if="menu==7">
        <rol></rol>
    </template>

    <template v-if="menu==8">
        <aerolinea></aerolinea>
    </template>

    <template v-if="menu==9">
        <precio></precio>
    </template>

    <template v-if="menu==10">
        <avion></avion>
    </template>

    <template v-if="menu==11">
        <tipoavion></tipoavion>
    </template>

    <template v-if="menu==12">
        <h1>Contenido del menu Aeropuerto</h1>
    </template>
    <template v-if="menu==13">
        <aeropuerto></aeropuerto>
    </template>

    <template v-if="menu==14">
        <reserva></reserva>
    </template>

    <template v-if="menu==20">
        <cliente></cliente>
        </template>

    <template v-if="menu==17">
        <vuelo></vuelo>
    </template>  

    <template v-if="menu==21">
        <empleado></empleado>
    </template> 
    
    @elseif(Auth::user()->idrol == 2)

    <template v-if="menu==1">
        <clasevuelo></clasevuelo>
    </template>

    <template v-if="menu==2">
        <horario></horario>
    </template>

    <template v-if="menu==3">
        <costos></costos>
    </template>

    <template v-if="menu==4">
        <tipocosto></tipocosto>
    </template>

    <template v-if="menu==5">
        <tipodocumento></tipodocumento>
    </template>

    <template v-if="menu==6">
    <user></user>
    </template>

    <template v-if="menu==7">
        <rol></rol>
    </template>

    <template v-if="menu==8">
        <aerolinea></aerolinea>
    </template>

    <template v-if="menu==9">
        <precio></precio>
    </template>

    <template v-if="menu==10">
        <avion></avion>
    </template>

    <template v-if="menu==11">
        <tipoavion></tipoavion>
    </template>

    <template v-if="menu==12">
        <h1>Contenido del menu Aeropuerto</h1>
    </template>
    <template v-if="menu==13">
        <aeropuerto></aeropuerto>
    </template>

    <template v-if="menu==14">
        <reserva></reserva>
    </template>

    <template v-if="menu==20">
        <cliente></cliente>

        </template>

        
    <template v-if="menu==17">
        <vuelo></vuelo>
    </template>   
       
    <template v-if="menu==21">
        <empleado></empleado>
    </template>

    @else

    @endif

    @endif

    <!--
    
    <template v-if="menu==1">
        <clasevuelo></clasevuelo>
    </template>

    <template v-if="menu==2">
        <horario></horario>
    </template>

    <template v-if="menu==3">
        <costos></costos>
    </template>

    <template v-if="menu==4">
        <tipocosto></tipocosto>
    </template>

    <template v-if="menu==5">
        <tipodocumento></tipodocumento>
    </template>

    <template v-if="menu==6">
    <user></user>
    </template>

    <template v-if="menu==7">
        <rol></rol>
    </template>

    <template v-if="menu==8">
        <aerolinea></aerolinea>
    </template>

    <template v-if="menu==9">
        <precio></precio>
    </template>

    <template v-if="menu==10">
        <avion></avion>
    </template>

    <template v-if="menu==11">
        <tipoavion></tipoavion>
    </template>

    <template v-if="menu==12">
        <h1>Contenido del menu Aeropuerto</h1>
    </template>
    <template v-if="menu==13">
        <aeropuerto></aeropuerto>
    </template>

    <template v-if="menu==14">
        <reserva></reserva>
    </template>

    <template v-if="menu==20">
        <cliente></cliente>

        </template>

        
    <template v-if="menu==17">
        <vuelo></vuelo>
    </template>   
    
    <template v-if="menu==21">
        <empleado></empleado>


    </template> -->

@endsection

