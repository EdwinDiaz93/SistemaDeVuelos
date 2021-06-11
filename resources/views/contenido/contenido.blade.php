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
        <h1>Contenido del menu Usuario</h1>
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
<<<<<<< HEAD
    <template v-if="menu==20">
        <cliente></cliente>
=======

    <template v-if="menu==17">
        <vuelo></vuelo>
>>>>>>> e389c3eea0e15f40dfafb759e95db93163a15e62
    </template>
@endsection
