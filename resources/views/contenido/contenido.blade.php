@extends('principal')
@section('contenido')
    
    <template v-if="menu==0">
        <h1>Contenido del menu 0</h1>
    </template>

    <template v-if="menu==1">
        <clasevuelo></clasevuelo>
    </template>

    <template v-if="menu==2">
        <h1>Contenido del menu 2</h1>
    </template>

    <template v-if="menu==3">
        <costos></costos>
    </template>

    <template v-if="menu==4">
        <tipocosto></tipocosto>
    </template>

    <template v-if="menu==5">
        <h1>Contenido del menu 5</h1>
    </template>

    <template v-if="menu==6">
        <rol></rol>
    </template>

    <template v-if="menu==7">
        <h1>Contenido del menu 7</h1>
    </template>

    <template v-if="menu==8">
        <h1>Contenido del menu 8</h1>
    </template>

    <template v-if="menu==9">
        <h1>Contenido del menu 9</h1>
    </template>

    <template v-if="menu==10">
        <h1>Contenido del menu 10</h1>
    </template>

    <template v-if="menu==11">
    <tipodocumento></tipodocumento>
    </template>

    <template v-if="menu==12">
        <redsocial></redsocial>
    </template>

    <template v-if="menu==13">
        <avion></avion>
    </template>

    <template v-if="menu==14">
        <tipoavion></tipoavion>
    </template>

<<<<<<< HEAD
    <template v-if="menu==13">
        <h1>Contenido del menu 12</h1>
    </template>
=======
    <template v-if="menu==15">
        <h1>Contenido del menu 13</h1>
    </template>

    <template v-if="menu==16">
        <h1>Contenido del menu 14</h1>
    </template>

>>>>>>> 42b7d48e930aec087d17b32cc97814c6e0e28cfa
    
    <template v-if="menu==14">
        <horario></horario>
    </template>
@endsection