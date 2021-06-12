@extends('principal')
@section('contenido')
    
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
<<<<<<< HEAD
        </template>
<<<<<<< HEAD
        
    <template v-if="menu==17">
        <vuelo></vuelo>
    </template>   
    
    <template v-if="menu==21">
        <empleado></empleado>

=======
=======
    </template>
>>>>>>> EdwinDiaz93
    
    <template v-if="menu==17">
        <vuelo></vuelo>
>>>>>>> d612e5a0d1f04fb45227d17ffb521da02978a9b0
    </template>
@endsection
