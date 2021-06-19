<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Aeropuertos</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;
        }

        #imagen {
            width: 100px;
            text-align: center;
        }

        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #c2cfd6;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #c2cfd6;
        }

        th,
        td {
            display: table-cell;
            vertical-align: inherit;
        }

        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .izquierda {
            float: left;
        }

        .derecha {
            float: right;
        }

        h1 {
            text-align: center;
        }

        p.centrado {
            text-align: center;
        }
    </style>
</head>

<body>

    <div>
        <h1>Sistema de Vuelos</h1>
        <div>

            <p class="centrado">
                <img src="img/avion1.png">
            </p>
            <div>
                <h3>
                    Reservas Realizadas <span class="derecha"> {{now()}} </span>
                </h3>
            </div>
            <div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                        
                            <th>Nombre del Cliente</th>
                            <th>Aerolinea</th>
                            <th>Aeropuerto Origen</th>
                            <th>Aeropuerto Destino</th>
                            <th>Horario de Vuelo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservas as $r)
                        @foreach($vuelos as $v)
                        @if($r->vuelo_id == $v->idvuelo)
                        <tr>

                            <td> {{$v->aerolinea->nombreaerolinea}}</td>
                            <td> {{$r->cliente->nomcontacto}}</td>
                            <td>{{$v->aeropuertoida->nomaeropuerto}}</td>
                            <td>{{$v->aeropuertoreg->nomaeropuerto}}</td>
                            <td>LLegada:{{$v->horarioreg->fecha}} - Salida: {{$v->horarioida->fecha}}</td>
                            <td> {{$r->estado?'Pagado':'Pendiente'}} </td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="izquierda">
                <p> <strong>Total de Registros: </strong> {{$cont}}</p>
            </div>

</body>

</html>